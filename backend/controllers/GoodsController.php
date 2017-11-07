<?php

namespace backend\controllers;

use backend\models\Brand;
use backend\models\Goods;
use backend\models\GoodsCaetgory;
use backend\models\GoodsDayCount;
use backend\models\GoodsDetails;
use backend\models\GoodsImg;
use flyok666\qiniu\Qiniu;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class GoodsController extends \yii\web\Controller
{
    public function actions()
    {

        return [
            'browse-images' => [
                'class' => 'bajadev\ckeditor\actions\BrowseAction',
                'quality' => 80,
                'maxWidth' => 800,
                'maxHeight' => 800,
                'useHash' => true,
                'url' => '@web/contents/',
                'path' => '@frontend/web/contents/',
            ],
            'upload-images' => [
                'class' => 'bajadev\ckeditor\actions\UploadAction',
                'quality' => 80,
                'maxWidth' => 800,
                'maxHeight' => 800,
                'useHash' => true,
                'url' => '@web/contents/',
                'path' => '@frontend/web/contents/',
            ],
        ];
    }


    /**
     * 商品列表分页显示
     * @return string
     */
    public function actionIndex()
    {
        $count=Goods::find()->count();
        $pageSize=5;
        $pagination=new Pagination(
            [
                //传递每页显示的条数
                'pageSize' => $pageSize,
                //传递数据总条数
                'totalCount' => $count,
            ]
        );
        $goods=Goods::find()->where(['!=','status','2'])->limit($pagination->limit)->offset($pagination->offset)->all();
        return $this->render('index',['goods' => $goods,'pagination'=>$pagination]);
    }

    /**
     * 添加商品
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        $goods=new Goods();
        $goodsDetails=new GoodsDetails();
        $goodsDaycount=new GoodsDayCount();
        $cate=ArrayHelper::map(GoodsCaetgory::find()->where(['depth'=>1])->all(),'id','name');
        $brand=ArrayHelper::map(Brand::find()->all(),'id','name');
        $re=\Yii::$app->request;
        if($re->isPost) {
            $data = $re->post();
//           var_dump($data);exit;
            //绑数据到模型
            $goods->load($data);
            //货号自动生成
            if(empty($data['Goods']['sn'])){
                $ymd=date('Ymd',time());
                $count=$goodsDaycount->findOne(['day'=>$ymd]);
                if(!$count){
                    $goods->sn=$ymd.'0000001';
                }else{
                    $sn=$count->count + 1;
                    $goods->sn=$ymd.substr('0000000'.$sn, -7);
                }
            }
//            var_dump($goods);exit;
            $goodsDetails->load($data);
            //保存商品信息
            if ($goods->save()) {
                //更新每日商品添加数据统计
                if(!$count){
                    $goodsDaycount->day=date('Ymd',time());
                    $goodsDaycount->count=1;
                    $goodsDaycount->insert();
                }else{
                    $count->count=$sn;
                    $count->update();
                }


                //获取商品ID 关联到商品详情ID
                $goodsDetails->goods_id = $goods->id;
                //保存商品详情内容
                $goodsDetails->save();
                //多图循环存入数据库
                foreach ($data['Goods']['imgPath'] as $k => $v) {
                    $goodsImg=new GoodsImg();
                    $goodsImg->goods_id = $goods->id;
                    $goodsImg->img = $v;
                    $goodsImg->save();
                }

            }else{
                var_dump($goods->getErrors());exit;
            }

            \Yii::$app->session->setFlash("success", "添加成功");
            return $this->redirect(['goods/index']);
        }
        return $this->render('add',['goods'=>$goods,'goodsDetails'=>$goodsDetails,'cate'=>$cate,'brand'=>$brand]);
    }


    public function actionEdit($id)
    {
        $goods=Goods::findOne($id);
        $goodsDetails=GoodsDetails::findOne(['goods_id'=>$id]);
        $goodsImgs=GoodsImg::find()->where(['goods_id'=>$id])->all();
        $cate=ArrayHelper::map(GoodsCaetgory::find()->where(['depth'=>1])->all(),'id','name');
        $brand=ArrayHelper::map(Brand::find()->all(),'id','name');
        $re=\Yii::$app->request;
        if($re->isPost) {
            $data = $re->post();
            //绑数据到模型
            $goods->load($data);
            $goodsDetails->load($data);
            //保存商品信息
            if ($goods->save()) {
                //获取商品ID 关联到商品详情ID
                $goodsDetails->goods_id = $goods->id;
                //保存商品详情内容
                $goodsDetails->save();
                //多图循环存入数据库
                foreach ($data['Goods']['imgPath'] as $k => $v) {
                    $goodsImg=new GoodsImg();
                    $goodsImg->goods_id = $goods->id;
                    $goodsImg->img = $v;
                    $goodsImg->save();
                }

            }else{
                var_dump($goods->getErrors());exit;
            }

            \Yii::$app->session->setFlash("success", "修改成功");
            return $this->redirect(['goods/index']);
        }

        foreach ($goodsImgs as $goodsImg){
            $goods->imgPath[]=$goodsImg->img;
        }
//        var_dump($goods);exit;
        return $this->render('add',['goods'=>$goods,'goodsDetails'=>$goodsDetails,'cate'=>$cate,'brand'=>$brand,'goodsImg'=>$goodsImg]);

    }



    /**
     * 四张表关联删除（goods  goodDayCount  goodsDetails goodsImg）
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDel($id)
    {
        if (Goods::findOne($id)->delete()) {
            if (GoodsDetails::deleteAll(['goods_id'=>$id]))
            {
                GoodsImg::deleteAll(['goods_id'=>$id]);
            }
            //通过session对象实现提示跳转提示
            \Yii::$app->session->setFlash("success","删除成功");
            return $this->redirect(['goods/index']);
        }

    }


    /**
     *七牛云多图上传
     */
    public function actionUpload()
    {
    //七牛云图片上传
        $config = [
            //AK
            'accessKey'=>'nj6THiSvr-EU_UKq4v8y5Sn6yI4NUMl_qscHH5SJ',
            //sK
            'secretKey'=>'agcgICaWx7GCBSLqW3DvQJTfv6PQ4qIqDZ48OF0R',
            //域名
            'domain'=>'http://7xl74q.com1.z0.glb.clouddn.com',
            //空间名称
            'bucket'=>'iyaku',
            'area'=>Qiniu::AREA_HUADONG
        ];
        //实例化七牛云对象
        $qiniu = new Qiniu($config);
        //构造一个图片名称
        $key = time().rand(100000,99999999);
        $qiniu->uploadFile($_FILES['file']['tmp_name'],$key);
        $url = $qiniu->getLink($key);
        $info=[
            'code'=>0,
            'url'=>$url,
            'attachment'=>$url,
        ];
        exit(Json::encode($info));
    }

}
