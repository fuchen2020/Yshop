<?php

namespace backend\controllers;
use Yii;
use backend\models\Admin;

class AdminController extends \yii\web\Controller
{
    /**
     * 管理员列表
     * @return string
     */
    public function actionIndex()
    {
        $admins=Admin::find()->all();
        return $this->render('index',['admins'=>$admins]);
    }

    /**
     * 管理员添加
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        $admin=new Admin();
        $re=\Yii::$app->request;
        if($re->isPost){

            if($admin->load($re->post()) && $admin->validate()){

                //hash加密
                    $pass=\Yii::$app->security->generatePasswordHash($admin->password);
                    $admin->password=$pass;
                    $admin->save();
                    \Yii::$app->session->setFlash('success','添加成功');
                    return $this->redirect(['index']);
            }else{
                $admin->getErrors();exit;
            }

        }

//        var_dump(\Yii::$app->request->getUserIP());exit;
        return $this->render('add',['admin'=>$admin]);

    }

    /**
     * 管理员数据修改
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionEdit($id)
    {
        $admin=Admin::findOne($id);
        $re=\Yii::$app->request;
        if($re->isPost){

            if($admin->load($re->post()) && $admin->validate()){

                //hash加密
                $pass=\Yii::$app->security->generatePasswordHash($admin->password);
                $admin->password=$pass;
                $admin->save();
                \Yii::$app->session->setFlash('success','修改成功');
                return $this->redirect(['index']);
            }else{
                $admin->getErrors();exit;
            }

        }

//        var_dump(\Yii::$app->request->getUserIP());exit;
        $admin->password="";
        return $this->render('add',['admin'=>$admin]);

    }

    /**
     * 管理员删除
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDel($id)
    {
        if(Admin::findOne($id)->delete()){
            \Yii::$app->session->setFlash('success','删除成功');
            return $this->redirect(['index']);
        }

    }

    /**
     * 后台登陆
     * @return string|\yii\web\Response
     */
//<?= $form->field($model, 'rememberMe')->checkbox()
    public function actionLogin()
    {
        $model=new Admin();
        $re=Yii::$app->request;
        if($re->isPost){
//            var_dump($re->post()['Admin']['username']);exit;
            $admin=Admin::findOne(['username'=>$re->post()['Admin']['username']]);
//            var_dump($re->post()['Admin']['password'],$admin->password);exit;

            if($admin){
                $pass=Yii::$app->security->validatePassword($re->post()['Admin']['password'],$admin->password);
//                var_dump($pass);exit;
                if($pass){
                    $admin->auth_key=Yii::$app->security->generateRandomString();
                    $admin->last_lg_time=time();
                    $admin->last_lg_ip=Yii::$app->request->getUserIP();
                    $admin->save();
                    Yii::$app->user->login($admin,3600*24*30);
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('login', ['model' => $model]);
    }

    /**
     * 退出登陆
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


}
