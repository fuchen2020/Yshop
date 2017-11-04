<?php

namespace backend\controllers;

use backend\models\Brand;
use suncky\yii\widgets\webuploader\actions\AttachmentUploaderAction;
use suncky\yii\widgets\webuploader\actions\ImageUploaderAction;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\UploadedFile;
use flyok666\qiniu\Qiniu;

class BrandController extends \yii\web\Controller
{


    /**
     * 品牌列表页 分页显示
     * @return string
     */
    public function actionIndex()
    {
        //查出总条数
        $count=Brand::find()->where(['!=','status','-1'])->count();
        //每页显示的条数
        $pageSize=5;
        // 使用总数来创建一个分页对象
        $pagination = new Pagination(['pageSize' => $pageSize,'totalCount' => $count]);

        //查出状态不为-1（软删除）的数据
        $brands=Brand::find()->where(['!=','status','-1'])->limit($pagination->limit)->offset($pagination->offset)->all();
//        $brands=Brand::find()->all();
        return $this->render('index',['brands'=>$brands,'pagination' => $pagination]);
    }

    /**
     * 品牌添加
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        $model=new Brand();
        $request=\Yii::$app->request;

        if($model->load($request->post())){
            $model->save();
            //通过session对象实现提示跳转提示
            \Yii::$app->session->setFlash("success","添加成功");
            return $this->redirect(['brand/index']);
        }
        $model->status=1;
        return $this->render('add',['model'=>$model]);
    }

    /**
     * 品牌修改
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionEdit($id)
    {

        $model=Brand::findOne($id);
        $request=\Yii::$app->request;
        if($model->load($request->post())){
            $model->save();
            //通过session对象实现提示跳转提示
            \Yii::$app->session->setFlash("success","修改成功");
            return $this->redirect(['brand/index']);
        }
        return $this->render('add',['model'=>$model]);
    }

    /**
     * 品牌逻辑删除（软删除）
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDel($id)
    {
        $model=Brand::findOne($id);
        $model->status=-1;
        $model->save();
        //通过session对象实现提示跳转提示
        \Yii::$app->session->setFlash("success","删除成功");
        return $this->redirect(['brand/index']);
    }

    /**
     * 恢复所有软删除数据
     * @return \yii\web\Response
     */

    public function actionRestore()
    {
        Brand::updateAll(['status'=>'1'],['status'=>-1]);
        //通过session对象实现提示跳转提示
        \Yii::$app->session->setFlash("success","恢复成功");
        return $this->redirect(['brand/index']);
    }

    public function actionUpload()
    {
//      $info=[
//            'code'=>0,
//            //回显图片
//            'url'=>'http://wh.itsource.cn/upload/superStar/superStar_picture/2017-09-18/304caf33-67ae-459a-a2bb-44bd84df68c4.jpg',
//           //相对路径
//            'attachment'=>'http://wh.itsource.cn/upload/superStar/superStar_picture/2017-09-18/304caf33-67ae-459a-a2bb-44bd84df68c4.jpg'
//        ];

//        var_dump($_FILES);exit;
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
        $key = time().rand(10000,999999);
        $qiniu->uploadFile($_FILES['file']['tmp_name'],$key);
        $url = $qiniu->getLink($key);

        //返回      {"code": 0, "url": "http://domain/图片地址", "attachment": "图片地址"}
        $info=[
          'code'=>0,
            'url'=>$url,
            'attachment'=>$url,
        ];
        exit(Json::encode($info));
    }
    
    
}
