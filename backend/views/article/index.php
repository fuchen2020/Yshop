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
<h1>文章列表</h1>
<?php
echo \yii\helpers\Html::a('添加文章',['add'],['class'=>"btn btn-info"]);
?>

    <!--数据显示表格-->
    <table class="table table-hover" id="tab">
        <tr style="font-size: 18px;font-weight: bold;" id="th">
            <td>ID</td>
            <td>标题</td>
            <td>分类</td>
            <td>状态</td>
            <td>排序</td>
            <td>发布时间</td>
            <td>最后修改</td>
            <td>操作</td>
        </tr>

        <?php foreach ($articles as $article):?>
            <tr>
                <td><?=$article->id ?></td>
                <td><?=$article->name ?></td>
                <td><?=$article->type ?></td>
                <td>
                    <span class="glyphicon glyphicon-<?=$article->status? 'ok green':'remove red'?>"></span>
                </td>
                <td><?=$article->sort ?></td>
                <td><?=date('Y-m-d H:s:i',$article->addtime) ?></td>
                <td><?=date('Y-m-d H:s:i',$article->edittime) ?></td>
                <td>
                    <?php
                    echo \yii\bootstrap\Html::a('修改',['article/edit?id='.$article->id],['class'=>'btn btn-info']);
                    echo "&nbsp;";
                    echo \yii\bootstrap\Html::a('删除',['article/del?id='.$article->id],['class'=>'btn btn-danger']);
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
