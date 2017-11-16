<?php

namespace frontend\controllers;

use frontend\models\Users;
use Mrgoon\AliSms\AliSms;
use Yii;

class UsersController extends \yii\web\Controller
{
    //引用login模板
    public $layout="login";
    public $enableCsrfValidation=false;
    /**
     * 阿里大于短信验证
     */
    public function actionSms($tel)
    {
        $config = [
            'access_key' => 'LTAIC9WOvaVWmNxE',
            'access_secret' => 'iqIRngOoyORKdJcLSdGQbQgtZwK096',
            'sign_name' => '唯美语言',
        ];
        if(!empty($tel)){
            $sms = new AliSms();
            //生成A-Z，0-9 的数组
            $str = array_merge(range('A','Z'),range(0,9));
            //打乱数组元素排序
            shuffle($str);
            //数组中根据条件取出4个元素值，转成字符串
            $codeContent = implode('',array_slice($str,0,4));
            $response = $sms->sendSms($tel, 'SMS_101190049', ['code'=>$codeContent], $config);
            if($response->Message==='OK'){
                \Yii::$app->session->set($tel,$codeContent);
            }
        }

    }

    /**
     * 用户注册
     * @return string|\yii\web\Response
     */
    public function actionReg()
    {
        $user=new Users();
        $re=\Yii::$app->request;
        if($re->isPost){
            if($user->load($re->post())){
                if($user->validate()){
                    $user->password_hash=\Yii::$app->security->generatePasswordHash($user->password);
                    $ip=\Yii::$app->request->getUserIP();
                    $user->last_login_ip=ip2long($ip);
                    $user->save();
//                    var_dump($user);exit;
                    \Yii::$app->session->setFlash('success','注册成功');
                    return $this->redirect(['reg']);
                }else{
//                    var_dump($user->getErrors());exit;
                    $error=$user->getErrors();
                    $errors="";
                    foreach ($error as $k=>$v){
                      $errors.='==>'.$v[0];
                    }
                    \Yii::$app->session->setFlash('danger',"$errors");
                    return $this->redirect(['reg']);
                }
            }
          }
        return $this->render('reg');
    }

    /**
     * 用户登陆
     * @return string|\yii\web\Response
     */

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
//            return $this->goHome();
            return $this->redirect(['index']);
        }
        $model=new Users();
        $re=\Yii::$app->request;
        if($re->isPost){
            $model->load($re->post());
//            var_dump($model->username);exit;
            $user=Users::findOne(['username'=>$model->username]);
//            var_dump($user->password_hash);
//            var_dump($model->password);
//            $ss=\Yii::$app->security->validatePassword($model->password,$user->password_hash);
//            var_dump($ss);exit;
            if($user){
                if(\Yii::$app->security->validatePassword($model->password,$user->password_hash)==true){
                    $user->auth_key=\Yii::$app->security->generateRandomString();
                    $user->last_login_time=time();
                    $user->last_login_ip=ip2long(\Yii::$app->request->getUserIP());
                    $user->save();
                    \Yii::$app->user->login($user,$model->rememberMe?3600*24*7:0);
//                    \Yii::$app->session->setFlash('success','登陆成功');
                    echo "<script>alert('登陆成功');window.location.href ='index'</script>";
//                    return $this->redirect(['index']);
                }else{
                    echo "<script>alert('密码不正确');window.location.href ='login'</script>";
                }
            }else{
                echo "<script>alert('账号不正确');window.location.href ='login'</script>";
//                \Yii::$app->session->setFlash('danger','账号不正确');
//                return $this->redirect(['login']);
            }
        }
        return $this->render('login');
    }

    /**
     * 退出登陆
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        \Yii::$app->user->logout();
//        return $this->goHome();
        return $this->redirect(['login']);
    }



}
