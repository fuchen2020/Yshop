<?php

namespace backend\controllers;

use backend\models\Brand;
use yii\data\Pagination;
use yii\web\UploadedFile;

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
            $model->imgFile=UploadedFile::getInstance($model,'imgFile');
            $filePath='images/brand/'.time().".".$model->imgFile->extension;
            $model->imgFile->saveAs($filePath,false);
            //追加图片路径到真实数据库模型类的属性
            $model->logo=$filePath;
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
            $model->imgFile = UploadedFile::getInstance($model, 'imgFile');
            if($model->imgFile){
                $filePath = 'images/brand/' . time() . "." . $model->imgFile->extension;
                $model->imgFile->saveAs($filePath, false);
                //追加图片路径到真实数据库模型类的属性
                $model->logo = $filePath;
            }

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


}
