<?php

namespace backend\controllers;

use backend\components\MenuQuery;
use backend\models\GoodsCaetgory;
use yii\helpers\Json;

class GoodsCaetgoryController extends \yii\web\Controller
{
    /**
     * 分类列表显示
     * @return string
     */
    public function actionIndex()
    {
        $cates=GoodsCaetgory::find()->orderBy('tree,lft')->all();

        return $this->render('index',['cates'=>$cates]);
    }

    public function actionAdd()
    {
        $model=new GoodsCaetgory();
        $request=\Yii::$app->request;
        if($request->isPost){
            $model->load($request->post());
//            var_dump($model);exit;
            if($model->validate()){
                if($model->parent_id=='0'){
                    $model->makeRoot();
                }else{
                    $parent=GoodsCaetgory::findOne(['id'=>$model->parent_id]);
                    $model->prependTo($parent);
                }
                \Yii::$app->session->setFlash("success",'添加分类成功');
                return $this->redirect(['add']);
            }
        }
        //得到所有的分类
        $catess=GoodsCaetgory::find()->asArray()->all();
        $catess[]=['id'=>0,'parent_id'=>0,'name'=>'顶级分类'];
        $catess=Json::encode($catess);

        return $this->render('add',['model'=>$model,'catess'=>$catess]);

    }



}
