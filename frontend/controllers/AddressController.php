<?php

namespace frontend\controllers;

use frontend\models\Address;
use frontend\models\Users;

class AddressController extends \yii\web\Controller
{
    //调用模板
    public $layout='userinfo';
    public $enableCsrfValidation=false;
    /**
     * 显示地址管理页面
     * @return string
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->isGuest) {
            return $this->redirect(['users/login']);
        }

        $ress=Address::find()->where(['users_id'=>\Yii::$app->user->identity->getId()])->all();

        return $this->render('index',compact('ress'));
    }

    public function actionAdd()
    {
        $re=\Yii::$app->request;
        $model=new Address();
        if($model->load($re->post())){
            if($model->save()){
                if($model->default){
//                    var_dump($model);exit;
                    $user=Users::findOne($model->users_id);
                    $user->default_address=$model->id;
                    $user->save();
                }
                echo "<script>alert('添加成功');window.location.href ='index'</script>";
            }else{
                echo "<script>alert('添加失败');window.location.href ='index'</script>";
            }
        }

    }

    /**
     * 地址修改
     * @param $id
     * @return string
     */
    public function actionEdit($id)
    {
        $re=\Yii::$app->request;
        $ress=Address::findOne($id);
//        var_dump($ress);exit;
        if($re->isPost){
            if($ress->load($re->post())){
                if($ress->save()){
                    if($ress->default){
//                    var_dump($model);exit;
                        $user=Users::findOne($ress->users_id);
                        $user->default_address=$ress->id;
                        $user->save();
                    }
                    echo "<script>alert('修改成功');window.location.href ='index'</script>";
                }else{
                    echo "<script>alert('修改失败');window.location.href ='index'</script>";
                }
            }

        }

        return $this->render('edit',compact('ress'));
    }

    /**
     * 删除地址
     * @param $id
     */
    public function actionDel($id)
    {
        if(Address::findOne($id)->delete()){
            echo "<script>alert('删除成功');window.location.href ='index'</script>";
        }

    }

    public function actionDefault($id,$u_id)
    {
        $user=Users::findOne($u_id);
        $user->default_address=$id;
        if($user->save()){
            echo "<script>alert('设置默认地址成功');window.location.href ='index'</script>";
        }
    }

}
