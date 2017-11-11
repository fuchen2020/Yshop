<?php
/* @var $this yii\web\View */
?>
<h1>权限列表</h1>
<?= \yii\bootstrap\Html::a('添加权限',['add'],['class'=>'btn btn-info'])?>
<table class="table">
    <tr>
        <th>权限路由</th>
        <th>权限描述</th>
        <th>操作</th>
    </tr>
    <?php foreach ($pers as $per):?>
    <tr>
        <td><?=$per->name ?></td>
        <td><?=$per->description ?></td>
        <td>
            <?php
            echo \yii\bootstrap\Html::a('编辑',['edit','name'=>$per->name]);
            echo \yii\bootstrap\Html::a('删除',['del','name'=>$per->name]);
            ?>
        </td>
    </tr>
    <?php endforeach;?>

</table>
