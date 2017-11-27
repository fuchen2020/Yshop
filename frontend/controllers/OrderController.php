<?php
/**
 * Created by PhpStorm.
 * Author: Floating dust
 * Date: 2017-11-21
 * Time: 16:04
 */

namespace frontend\controllers;


use backend\models\Goods;
use dosamigos\qrcode\QrCode;
use EasyWeChat\Foundation\Application;
use frontend\models\Address;
use frontend\models\Cart;
use frontend\models\Order;
use frontend\models\OrderDetail;
use frontend\models\Users;
use yii\db\Exception;
use yii\helpers\Url;
use yii\web\Controller;

class OrderController extends Controller
{
    public $totalPrice=0;
    public $enableCsrfValidation=false;


    /**
     * 订单页面显示
     * @return string
     */
    public function actionIndex()
    {
        //判断用户是否登陆
        if(\Yii::$app->user->isGuest){

            return $this->redirect(['users/login','backUrl'=>Url::to(['index'])]);
        }
        //取出地址信息
        $ress=Address::find()->where(['users_id'=>\Yii::$app->user->identity->getId()])->all();
//        var_dump($ress);exit;
        //取出默认地址
        $default_address=Users::findOne(\Yii::$app->user->id)->default_address;
        //快递信息
        $express=\Yii::$app->params['express'];
        //支付方式
        $pay_type=\Yii::$app->params['pay_type'];
//        var_dump($pay_type);exit;
        //购物车商品清单
        $u_id=\Yii::$app->user->getId();
        $goods= [];
        $carts=Cart::find()->where(['u_id'=>$u_id])->all();
        foreach ($carts as $cart){
            $good=Goods::find()->where(['id'=>$cart->g_id])->asArray()->one();
            $good['amount'] =$cart->amount;
            $goods[]=$good;
        }

        return $this->renderPartial('cart2',compact('express','pay_type','goods','ress','default_address'));
    }

    /**
     * 生成订单，处理
     * @throws Exception
     *
     */
    public function actionOrder()
    {
        $re = \Yii::$app->request;
//        var_dump($re->post());exit;
        //从数据库得到当前用户所有的购物车数据
        $u_Id=\Yii::$app->user->id;
        $carts=\frontend\models\Cart::find()->where(['u_id'=>$u_Id])->asArray()->all();
        $goods = [];
        //循环得到商品的信息
        foreach ($carts as $k=>$v) {
            //查出商品
            $good = Goods::find()->where(['id' => $v['g_id']])->asArray()->one();
            //每个商品的购买数量
            $good['amount'] = $v['amount'];
            $this->totalPrice +=$good['price']*$good['amount'];
            $goods[] = $good;
        }
        if ($re->isPost) {

            //开启事务
            $db = \Yii::$app->db;
            $transaction = $db->beginTransaction();
            try {
                //1.保存订单数据库
                 $order=new Order();
                 $address=Address::findOne($re->post('address_id'));
                 $order->users_id=\Yii::$app->user->id;
                 $order->name=$address->consignee;
                 $order->province=$address->province;
                 $order->city=$address->city;
                 $order->county=$address->county;
                 $order->detailed_address=$address->detailed_address;
                 $order->tel=$address->tel;
                 $order->express_id=$re->post('express_id');
                 $order->express_name=\Yii::$app->params['express'][$order->express_id]['express_name'];
                 $order->express_price=\Yii::$app->params['express'][$order->express_id]['express_price'];
                 $order->pay_type_id=$re->post('pay_type_id');
                 $order->pay_type_name=\Yii::$app->params['pay_type'][$order->pay_type_id];
                 //订单总价
                 $order->price=$this->totalPrice+$order->express_price;
                 $order->status=1;
                 //生成三方订单号：年月日时分秒+ 随机（10000,99999）+ U_id + Ex_id + Pay_id
                 $order->third_party_no=date("ymdHis").rand(10000,99999).$order->users_id.$order->express_id.$order->pay_type_id;
                 $order->create_at=time();
                //保存数据库
              if(!$order->save()) {

                  throw new Exception('订单创建失败');
              }
//                var_dump($order->getErrors());exit;
//                var_dump($goods);exit;
                //把订单商品入order_detail表
                foreach ($goods as $good){
                    $goodsModel=Goods::findOne($good['id']);
                    //判断库存是否充足
                    if ($good['amount']>$goodsModel->stock){
                        //抛出异常
                        throw new Exception("商品库存不足,请重新下单");
                    };
                    $orderDetail=new OrderDetail();
                    //订单Id
                    $orderDetail->order_id=$order->id;
                    $orderDetail->goods_id=$good['id'];
                    $orderDetail->amount=$good['amount'];
                    $orderDetail->goods_name=$good['name'];
                    $orderDetail->goods_logo=$good['logo'];
                    $orderDetail->goods_price=$good['price'];
                    $orderDetail->subtotal_price=$good['price']*$good['amount'];
                    $orderDetail->save();
                    //减商品表库存
                    $goodsModel->stock-=$good['amount'];
                    $goodsModel->save();
                }
                //清空购物车
                $u_Id=\Yii::$app->user->id;
                Cart::deleteAll(['u_id'=>$u_Id]);
                $transaction->commit();
                if($order->pay_type_id==3){
                    return $this->redirect(['cart3','orderId'=>$order->id]);
                }

            } catch (Exception $e) {
                $transaction->rollBack();
                //提示抛出的异常错误
                echo "<script>alert('".$e->getMessage()."')</script>";
            }
        }
    }

    /**
     * 发起微信支付请求
     * @param $orderId
     * @return mixed
     */
    public function actionPay($orderId){
        //查询当前订单
        $orderModel=Order::findOne($orderId);
        $orderDetail=OrderDetail::find()->where(['order_id'=>$orderId])->one();
        $app = new Application(\Yii::$app->params['wechatOption']);
        $payment = $app->payment;
        $attributes = [
            'trade_type'       => 'NATIVE', // JSAPI，NATIVE，APP... 交易类型
            'body'             => '京西商城订单',//商品描述
            'detail'           => $orderDetail->goods_name."...",//商品详情
            'out_trade_no'     => $orderModel->third_party_no,//订单号
            'total_fee'        => $orderModel->price*100, // 单位：分
            'notify_url'       => Url::to(['ok'],true), // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            //'openid'           => '当前用户的 openid', // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            // ...
        ];
        //生成订单
        $order = new \EasyWeChat\Payment\Order($attributes);
        //调用微信接口统一下单
        $result = $payment->prepare($order);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $prepayId = $result->prepay_id;
//            var_dump($result->code_url);exit;
            header('Content-Type: image/png');
//            return QrCode::png($result->code_url,false,3,6);
            return QrCode::png($result->code_url,false,3,6);
        }
        //   var_dump($result);
    }

    /**
     * 捕获微信支付返回结果
     * @return mixed
     */
    public function actionOk(){
        $app = new Application(\Yii::$app->params['wechatOption']);
        $response = $app->payment->handleNotify(function($notify, $successful){
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            // $order = 查询订单($notify->out_trade_no);
            //查询是否存在此订单
            $order=Order::find()->where(['trade_no'=>$notify->out_trade_no])->one();
            if (!$order) { // 如果订单不存在
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }
            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($order->status!=1) { // 如果不是等付款就说明已经操作
                return true; // 已经支付成功了就不再更新了
            }
            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
                // $order->paid_at = time(); // 更新支付时间为当前时间
                $order->status = 2;
            } else { // 用户支付失败
                // $order->status = 'paid_fail';
            }
            $order->save(); // 保存订单
            return true; // 返回处理完成
        });
        return $response;
    }


    /**
     * 订单完成页面，并返回支付二维码
     * @return string
     */
    public function actionCart3()
    {
        return $this->renderPartial('cart3');
    }

}