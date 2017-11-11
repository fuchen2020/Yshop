<?php

namespace backend\controllers;

use backend\models\AuthItem;
use yii\helpers\ArrayHelper;

class RoleController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $roles=\Yii::$app->authManager->getRoles();

        return $this->render('index',compact('roles'));
    }

    /**
     * 添加加色并赋予权限
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        $model=new AuthItem();
        $re=\Yii::$app->request;
        if($model->load($re->post()) && $model->validate()){
//            var_dump($model->permissions);exit;
            $auth=\Yii::$app->authManager;
            $role=$auth->createRole($model->name);
            $role->description=$model->description;
            if($auth->add($role))
            {
                if($model->permissions)
                {
//                    var_dump($model->permissions);exit;
                    //给用户添加权限
                    foreach ($model->permissions as $per)
                    {
                        //把权限名称添加到对应的角色中
                        $auth->addChild($role,$auth->getPermission($per));
                    }
                }
            }
            \Yii::$app->session->setFlash('success','添加'.$model->name.'成功');
            return $this->redirect(['index']);
        }
        //查询所有权限回显
        $per=\Yii::$app->authManager->getPermissions();
        $pers=ArrayHelper::map($per,'name','description');
//        var_dump($pers);exit;
        return $this->render('add',compact('model','pers'));
        
    }

    /**
     * 角色修改，角色权限修改
     * @param $name
     * @return string|\yii\web\Response
     */
    public function actionEdit($name)
    {
        $model=AuthItem::findOne($name);
        //查询当前角色对应的权限
        $rolePer=\Yii::$app->authManager->getPermissionsByRole($name);
        $model->permissions=array_keys($rolePer);
        $re=\Yii::$app->request;
        if($model->load($re->post()) && $model->validate()){
            $auth=\Yii::$app->authManager;
            //查询对应角色
            $role=$auth->getRole($model->name);
            if($role)
            {
                $role->description=$model->description;
                //判断是否修改成
                if($auth->update($model->name,$role))
                {
                    //修改权限要先删除角色之前所有权限
                    $auth->removeChildren($role);
                    //添加权限
                    if($model->permissions)
                    {
                        foreach ($model->permissions as $per)
                        {
                            //把权限名称添加到对应的角色中
                            $auth->addChild($role,$auth->getPermission($per));
                        }
                    }
                }
            }
            \Yii::$app->session->setFlash('success','修改'.$model->name.'成功');
            return $this->redirect(['index']);
        }
        //查询所有权限回显
        $per=\Yii::$app->authManager->getPermissions();
        $pers=ArrayHelper::map($per,'name','description');
        return $this->render('add',compact('model','pers'));

    }

    /**
     * 角色删除，角色权限删除
     * @param $name
     * @return \yii\web\Response
     */
    public function actionDel($name)
    {
        $auth=\Yii::$app->authManager;
        //先找到该角色
        $role=$auth->getRole($name);
        //删除角色权限
        $auth->removeChildren($role);
        if($auth->remove($role))
        {
            \Yii::$app->session->setFlash('success','删除'.$name.'成功');
            return $this->redirect(['index']);
        }

    }

}
