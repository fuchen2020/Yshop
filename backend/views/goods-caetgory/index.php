<?php
/* @var $this yii\web\View */
use leandrogehlen\treegrid\TreeGrid;
?>
<h1>商品分类列表</h1>
<?=\yii\bootstrap\Html::a("添加分类",['add'],['class'=>'btn btn-info'])?>
<?= TreeGrid::widget([
    'dataProvider' => $dataProvider,
    'keyColumnName' => 'id',
    'parentColumnName' => 'parent_id',
    'parentRootValue' => '0', //first parentId value
    'pluginOptions' => [
        'initialState' => 'collapsed',
    ],
    'columns' => [
        'name',
        'id',
        'parent_id',
        ['class' => '\backend\components\TreeColumn'],
    ]
]); ?>