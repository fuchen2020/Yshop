<?php

namespace backend\controllers;

use backend\models\ArticleCaetgory;

class ArticleCaetgoryController extends \yii\web\Controller
{
    /**
     * 文章分类列表
     * @return string
     */
    public function actionIndex()
    {
        $caetgory=ArticleCaetgory::find()->all();

        return $this->render('index', ['caetgorys' => $caetgory]);
    }

    /**
     * 文章分类添加
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        $model=new ArticleCaetgory;
        $request=\Yii::$app->request;
        if($model->load($request->post())){

            $model->save();
            \Yii::$app->session->setFlash('success','添加成功');
            return $this->redirect(['index']);
        }
        return $this->render('add',['model'=>$model]);
    }

    /**
     * 文章分类修改
     * @param $id
     * @return string|\yii\web\Response
     */

    public function actionEdit($id)
    {
        $model=ArticleCaetgory::findOne($id);
        $request=\Yii::$app->request;
        if($model->load($request->post())){

            $model->save();
            \Yii::$app->session->setFlash('success','修改成功');
            return $this->redirect(['index']);
        }
        return $this->render('add',['model'=>$model]);
    }

    /**
     * 删除文章分类
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDel($id)
    {
        if(ArticleCaetgory::findOne($id)->delete()){
            \Yii::$app->session->setFlash('success','删除成功');
            return $this->redirect(['index']);
        }
    }


}
