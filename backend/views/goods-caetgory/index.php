<?php
/* @var $this yii\web\View */
?>
<h1>商品分类列表</h1>
<?=\yii\bootstrap\Html::a("添加分类",['add'],['class'=>'btn btn-info'])?>
<table class="table">

    <tr>
        <th>Id</th>
        <th>名称</th>
        <th>操作</th>
    </tr>

    <?php foreach ($cates as $cate):?>
        <tr>
            <td><?=$cate->id?></td>
            <td><?=$cate->name ?></td>
<!--            <td>--><?//=$cate->nameText?><!--</td>-->

            <td>编辑 删除</td>
        </tr>


    <?php endforeach;?>

</table>