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
<h1>品牌列表</h1>
<a href="add" class="btn btn-info">添加品牌</a>&nbsp;&nbsp;
<a href="restore" class="btn btn-info">恢复删除</a>
<div class="container" style="margin-top:10px;text-align: center;">
    <!--数据显示表格-->
    <table class="table table-hover" id="tab">
        <tr style="font-size: 18px;font-weight: bold;" id="th">
            <td>ID</td>
            <td>品牌名称</td>
            <td>简介</td>
            <td>logo</td>
            <td>排序</td>
            <td>状态</td>
            <td>操作</td>
        </tr>

        <?php foreach ($brands as $brand):?>
            <tr>
                <td><?=$brand->id ?></td>
                <td><?=$brand->name ?></td>
                <td><?=$brand->intro ?></td>
                <td>
                  <?php
                  echo \yii\bootstrap\Html::img('/'.$brand->logo,['height'=>'40px']);
                  ?>
                </td>
                <td><?=$brand->sort ?></td>
                <td>
                    <span class="glyphicon glyphicon-<?=$brand->status? 'ok green':'remove red'?>"></span>
                </td>
                <td>
                    <?php
                    echo \yii\bootstrap\Html::a('修改',['brand/edit?id='.$brand->id],['class'=>'btn btn-info']);
                    echo "&nbsp;";
                    echo \yii\bootstrap\Html::a('删除',['brand/del?id='.$brand->id],['class'=>'btn btn-danger']);
                    ?>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
    <?php

    echo LinkPager::widget([
        'pagination' => $pagination,
    ]);

    ?>
</div>