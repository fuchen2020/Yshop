<?php

namespace backend\controllers;

use backend\models\AuthItem;
use yii\helpers\ArrayHelper;

class PerController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $pers=\Yii::$app->authManager->getPermissions();

        return $this->render('index',compact('pers'));
    }

    /**
     * 权限添加
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        $model=new AuthItem();
        $re=\Yii::$app->request;
        if($model->load($re->post()) && $model->validate()){
//            var_dump($model);exit;
            $auth=\Yii::$app->authManager;
            $per=$auth->createPermission($model->name);
            $per->description=$model->description;
            $auth->add($per);

            \Yii::$app->session->setFlash('success','添加'.$model->description.'成功');
            return $this->redirect(['index']);
        }

        return $this->render('add',compact('model'));
    }

    /**
     * 权限编辑
     * @param $name
     * @return string|\yii\web\Response
     */
    public function actionEdit($name)
    {
        $re=\Yii::$app->request;
        //查出权限
        $model=AuthItem::findOne($name);
        if($model->load($re->post()) && $model->validate()){
//            var_dump($model->name);exit;
            $auth=\Yii::$app->authManager;
            $per=$auth->getPermission($model->name);
//            var_dump($per);exit;
            if($per){
                $per->description=$model->description;
                $auth->update($model->name,$per);
                \Yii::$app->session->setFlash('success','修改'.$model->description.'成功');
                return $this->redirect(['index']);
            }else{
                \Yii::$app->session->setFlash("danger","不能修改权限名称".$model->name);
                return $this->refresh();
            }
        }
        return $this->render('add',compact('model'));

    }

    /**
     * 权限删除
     * @param $name
     * @return \yii\web\Response
     */
    public function actionDel($name)
    {
        $auth=\Yii::$app->authManager;
        if($auth->remove($auth->getPermission($name))){
            \Yii::$app->session->setFlash("success","删除权限".$name.'成功');
            return $this->redirect(['index']);
        }
    }

}
