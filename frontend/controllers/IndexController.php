<?php
/**
 * Created by PhpStorm.
 * Author: Floating dust
 * Date: 2017-11-17
 * Time: 22:57
 */

namespace frontend\controllers;


use backend\models\Goods;
use backend\models\GoodsCaetgory;
use frontend\models\Address;
use frontend\models\Cart;
use frontend\models\Users;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Cookie;

class IndexController extends Controller
{
    /**
     * 首页
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = 'index';
        $xiaomi = Goods::find()->where(['brand_id' => 3])->limit(5)->all();
        $hots = Goods::find()->where(['!=', 'brand_id', 3])->limit(3)->all();
        $jinpins = Goods::find()->where(['!=', 'brand_id', 3])->limit(8)->all();


        return $this->render('index', compact('xiaomi', 'hots', 'jinpins'));
    }

    /**
     * 商品分类 商品列表展示
     * @param $id
     * @return string
     */
    public function actionList($id)
    {
        $this->layout = 'list';
        //分类ID=5,看是否有小类,如果有,则取出所有的小类做成这个的格式 1,2,3
        // 然后SQL用 where pro_type in (1,2,3) 如果没有小类则用 where pro_type=5 就可以了.
        //子类左值比当前左值大，右值比当前右值小，就可以找到他所有子孙类
        //查当前分类ID数据
        $cate = GoodsCaetgory::findOne($id);
        //根据当前分类数据的树，左值，右值找到所有子孙节点
        $data = GoodsCaetgory::find()->where(['tree' => $cate->tree])->andWhere([">=", 'lft', $cate->lft])->andWhere(['<=', 'rgt', $cate->rgt])->all();
        //获取到分类ID
        $cate_id = array_column($data, 'id');
        //通过分类ID查询出商品数据
        $goods = Goods::find()->where(['goods_category_id' => $cate_id])->all();

        return $this->render('list', compact('goods'));
    }

    /**
     * 商品详情页面
     * @param $g_id
     * @return string
     */
    public function actionGoods($g_id)
    {
        $this->layout = 'goods';

        $goods = Goods::find()->where(['id' => $g_id])->all();

        return $this->render('goods', compact('goods'));
    }

    
    /**
     * 购物车页面显示1
     * @return string
     */
    public function actionCart()
    {
        if (\Yii::$app->user->isGuest) {
            //未登录
            $getCookie = \Yii::$app->request->cookies;
            //获取购物车数据
            $carts = $getCookie->has('cart')?$getCookie->getValue("cart"):[];
            $goodss =[];
            foreach ($carts as $g_id => $amount) {
                $good = Goods::find()->where(['id' => $g_id])->asArray()->one();
                $good['amount'] = $amount;
                $goodss[] = $good;
            }
        }else{
            //已登录
            $u_id=\Yii::$app->user->getId();
            $goodss = [];
            $carts=Cart::find()->where(['u_id'=>$u_id])->all();
            foreach ($carts as $cart){
                $goods=Goods::find()->where(['id'=>$cart->g_id])->asArray()->one();
//                var_dump($goods);
                $goods['amount'] =$cart->amount;
                $goodss[]=$goods;


            }
//            var_dump($goodss);exit;
        }

        //显示购物车视图
        return $this->renderPartial('cart', compact('goodss'));
    }

    /**
     * 商品添加购物车
     * @param $g_id 商品ID
     * @param $amount 购买数量
     */
    public function actionAddCart($g_id, $amount)
    {
        //未登陆
        if (\Yii::$app->user->isGuest) {
            //拼数组
            $cart = [$g_id => $amount];
            //获取ck对象
            $getCookie = \Yii::$app->request->cookies;
            //获取ck中是否已存在购物车数据，
            $frontCookie = $getCookie->has('cart') ? $getCookie->getValue('cart') : [];
            //判断前ck数据中是否存在该商品数据
            if (key_exists($g_id, $frontCookie)) {
                //有则在原数量上增加
                $frontCookie[$g_id] += $amount;
            } else {
                //无则追加整条新数据
                $frontCookie[$g_id] = $amount;
            }
            //设置ck
            $setCookie = \Yii::$app->response->cookies;
            //生成Ck对象(ck名称，值，过期时间)
            $cartCookie = new Cookie(
                [
                    'name' => 'cart',
                    'value' => $frontCookie,
                    'expire' => time() + 3600 * 24 * 7,
                ]
            );
            //保存ck 数据
            $setCookie->add($cartCookie);
            //跳转到购物车页面
            return $this->redirect(['cart']);
        } else {
            //已登陆
            $u_id=\Yii::$app->user->getId();
            $cart=Cart::find()->where(['g_id'=>$g_id,'u_id'=>$u_id])->one();
            if($cart){
                //赋值数据到模型对象
                $cart->amount+=$amount;
                $cart->save();
            }else{
                //赋值数据到模型对象
                $cart=new Cart();
                $cart->g_id=$g_id;
                $cart->amount=$amount;
                $cart->u_id=\Yii::$app->user->getId();
                $cart->save();
            }
             //跳转到购物车页面
            return $this->redirect(['cart']);
        }
    }

    /**
     * 购物车数据修改
     */
    public function actionCartEdit()
    {
        //接收ajax传值
        $re=\Yii::$app->request;
        $id=$re->post('g_id');
        $amount=$re->post('amount');
        //未登录
        if (\Yii::$app->user->isGuest){
            $getCookie=\Yii::$app->request->cookies;
            //取出购物车Cookie值
            $cart=$getCookie->getValue('cart');
            // 把对应数据的购买数量替换
            $cart[$id]=$amount;
            $setCookie=\Yii::$app->response->cookies;
            //创建cookie对象
            $cartCookie=new Cookie(
                [
                    'name'=>"cart",
                    'value'=>$cart,
                    'expire'=>time()+3600
                ]
            );
            //添加到cookie
            $setCookie->add($cartCookie);
        }else{
            //已登陆
            $u_id=\Yii::$app->user->getId();
            $cart=Cart::find()->where(['g_id'=>$id,'u_id'=>$u_id])->one();
            if($cart){
                //赋值数据到模型对象
                $cart->amount=$amount;
                $cart->save();
            }else{
                //赋值数据到模型对象
                $cart->g_id=$id;
                $cart->amount=$amount;
                $cart->u_id=\Yii::$app->user->getId();
                $cart->save();
            }
        }
    }

    /**购物车商品删除
     * @param $g_id
     */
    public function actionDel()
    {
        $request=\Yii::$app->request;
        $g_id=$request->post('g_id');
        if(\Yii::$app->user->isGuest){
            $re=\Yii::$app->carts->del($g_id)->save();
        }else{
            $re=Cart::deleteAll(['g_id'=>$g_id]);
        }
        if($re){
            return "success";
        }
    }




}