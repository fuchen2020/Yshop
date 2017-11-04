<?php

namespace backend\controllers;

use backend\models\Article;
use backend\models\ArticleCaetgory;
use backend\models\ArticleContent;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

class ArticleController extends \yii\web\Controller
{
    /**
     * 文章列表分页显示
     * @return string
     */
    public function actionIndex()
    {
        $count=ArticleContent::find()->count();
        $pageSize=5;
        $pagination=new Pagination(
            [
                //传递每页显示的条数
                'pageSize' => $pageSize,
                //传递数据总条数
                'totalCount' => $count,
            ]
        );
        $articles=Article::find()->limit($pagination->limit)->offset($pagination->offset)->all();
        return $this->render('index',['articles' => $articles,'pagination'=>$pagination]);
    }

    /**
     * 文章添加和添加文章内容
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        $article=new Article();
        $content=new ArticleContent();
        $request=\Yii::$app->request;
        $cate=ArticleCaetgory::find()->all();
        $options=ArrayHelper::map($cate,'id','name');
        if($request->isPost){
            //绑数据到模型
            $article->load($request->post());
            $content->load($request->post());
            //保存文章信息
            if($article->save()) {
                //获取文章ID 关联到内容ID
                $content->id = $article->id;
                //保存文章内容
                $content->save();
            }
                //提示跳转
                \Yii::$app->session->setFlash('success','添加成功');
                return $this->redirect(['index']);
            }
        return $this->render('add',['model'=>$article,'content'=>$content,'options'=>$options]);
    }

    /**
     * 文章修改和修改文章内容
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionEdit($id)
    {
        $article=Article::findOne($id);
        $content=ArticleContent::findOne($id);
        $request=\Yii::$app->request;
        $cate=ArticleCaetgory::find()->all();
        $options=ArrayHelper::map($cate,'id','name');
        if($request->isPost){
            //绑数据到模型
            $article->load($request->post());
            $content->load($request->post());
            //保存文章信息
            if($article->save()) {
                //获取文章ID 关联到内容ID
                $content->id = $article->id;
                //保存文章内容
                $content->save();
            }
            //提示跳转
            \Yii::$app->session->setFlash('success','修改成功');
            return $this->redirect(['index']);
        }
        return $this->render('add',['model'=>$article,'content'=>$content,'options'=>$options]);
    }

    /**
     * 删除文章表和文章内容表数据
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDel($id)
    {
        if(Article::findOne($id)->delete() && ArticleContent::findOne($id)->delete()){
            \Yii::$app->session->setFlash('success','删除成功');
            return $this->redirect(['index']);
        }
    }

}
