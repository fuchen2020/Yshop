<?php
/* @var $this yii\web\View */
use yii\widgets\LinkPager;
?>
<style>
    .green{
        color: green;
    }
    .red{
        color: red;
    }
</style>
<h1>文章分类列表</h1>
<?php
echo \yii\helpers\Html::a('添加分类',['add'],['class'=>"btn btn-info"]);
?>
<div class="container" style="margin-top:10px;text-align: center;">
    <!--数据显示表格-->
    <table class="table table-hover" id="tab">
        <tr style="font-size: 18px;font-weight: bold;" id="th">
            <td>ID</td>
            <td>名称</td>
            <td>简介</td>
            <td>状态</td>
            <td>排序</td>
            <td>操作</td>
        </tr>

        <?php foreach ($caetgorys as $category):?>
            <tr>
                <td><?=$category->id ?></td>
                <td><?=$category->name ?></td>
                <td><?=$category->intro ?></td>
                <td>
                    <span class="glyphicon glyphicon-<?=$category->status? 'ok green':'remove red'?>"></span>
                </td>
                <td><?=$category->sort ?></td>
                <td>
                    <?php
                    echo \yii\bootstrap\Html::a('修改',['article-caetgory/edit?id='.$category->id],['class'=>'btn btn-info']);
                    echo "&nbsp;";
                    echo \yii\bootstrap\Html::a('删除',['article-caetgory/del?id='.$category->id],['class'=>'btn btn-danger']);
                    ?>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
    <?php

//    echo LinkPager::widget([
//        'pagination' => $pagination,
//    ]);
//
//    ?>
</div>
