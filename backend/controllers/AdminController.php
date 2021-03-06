<?php

namespace backend\controllers;
use Yii;
use backend\models\Admin;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;

class AdminController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
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
     * 显示后台首页
     * @return string
     */
    public function actionHome()
    {
        return $this->render('home');
    }

    /**
     * 管理员添加
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        $admin=new Admin();
        $auth=Yii::$app->authManager;
        $re=\Yii::$app->request;
        if($re->isPost){

            if($admin->load($re->post()) && $admin->validate()){

                //hash加密
                    $pass=\Yii::$app->security->generatePasswordHash($admin->password);
                    $admin->password=$pass;
                    if($admin->save())
                    {
                        $role=$auth->getRole($admin->role);
                        $auth->assign($role,$admin->id);
                    }
                    \Yii::$app->session->setFlash('success','添加成功');
                    return $this->redirect(['index']);
            }else{
                $admin->getErrors();exit;
            }
        }

        $role=$auth->getRoles();
        $roles=ArrayHelper::map($role,'name','name');
//        var_dump(\Yii::$app->request->getUserIP());exit;
        return $this->render('add',['admin'=>$admin,'roles'=>$roles]);

    }

    /**
     * 管理员数据修改
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionEdit($id)
    {
        $admin=Admin::findOne($id);
        $auth=Yii::$app->authManager;
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
        $role=$auth->getRoles();
        $roles=ArrayHelper::map($role,'name','name');
        return $this->render('add',['admin'=>$admin, 'roles' => $roles]);

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

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
            return $this->redirect(['index']);
        }
        $model=new Admin();
        $re=Yii::$app->request;
        if($re->isPost){
            $model->load($re->post());
            $admin=Admin::findOne(['username'=>$re->post()['username']]);
            if($admin){
                if(Yii::$app->security->validatePassword($re->post()['password'],$admin->password)){
                    $admin->auth_key=Yii::$app->security->generateRandomString();
                    $admin->last_lg_time=time();
                    $admin->last_lg_ip=Yii::$app->request->getUserIP();
                    $admin->save();
                    Yii::$app->user->login($admin,$model->rememberMe?3600*24*7:0);
                    Yii::$app->session->setFlash('success','登陆成功');
                    return $this->redirect(['home']);
                }else{
                    $model->addError('password','密码不正确');
                }
            }else{
                $model->addError('username','账号不存在');
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
//        return $this->goHome();
        return $this->redirect(['login']);
    }

    public function actionUpdate($id)
    {
        $admin=Admin::findOne($id);
        $re=Yii::$app->request;
        if($re->isPost){
//            var_dump($re->post());exit;
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


        $admin->password="";
        return $this->render('update',compact('admin'));
    }


}
