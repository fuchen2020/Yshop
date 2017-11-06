<?php

namespace backend\controllers;

use backend\components\MenuQuery;
use backend\models\Dels;
use backend\models\GoodsCaetgory;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;

class GoodsCaetgoryController extends \yii\web\Controller
{
    /**
     * 分类列表显示
     * @return string
     */
    public function actionIndex()
    {
        $query = GoodsCaetgory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);

//        $cates=GoodsCaetgory::find()->orderBy('tree,lft')->all();
//
//        return $this->render('index',['cates'=>$cates]);
    }

    /**
     * 商品分类添加
     * @return string|\yii\web\Response
     */
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

    public function actionUpdate($id)
    {
        $model=GoodsCaetgory::findOne($id);
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

    /**
     * 商品分类的删除
     * 利用了两个模型类（GoodsCaetgory，Dels），其中Dels只用于删除深度为0的根节点
     * @param $id
     * @return \yii\web\Response
     *
     */
    public function actionDelete($id)
    {
        //获取某分类的所有子孙分类
        $category = GoodsCaetgory::findOne(['parent_id'=>$id]);
//        GoodsCaetgory::findOne($id)->deleteWithChildren();
//        var_dump($category);exit;
        if($category==null){
            $depths=Dels::findOne($id)->depth;
//            var_dump($depths);exit;
            if($depths===0){
//                Dels::findOne($id)->delete();
                GoodsCaetgory::findOne($id)->deleteWithChildren();
            }else{
                GoodsCaetgory::findOne($id)->delete();
            }
                \Yii::$app->session->setFlash("success",'删除分类成功');
                return $this->redirect(['index']);
        }else{
            \Yii::$app->session->setFlash("danger",'不能直接删除有子孙分类的分类');
            return $this->redirect(['index']);
        }
    }

}
