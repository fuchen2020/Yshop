<?php
/* @var $this yii\web\View */
use yii\widgets\LinkPager;
?>

<h1>商品列表</h1>
<?php
echo \yii\helpers\Html::a('添加商品',['add'],['class'=>"btn btn-info"]);
?>
<div class="container" style="margin-top:10px;text-align: center;">
    <!--数据显示表格-->
    <table class="table table-hover" id="tab">
        <tr style="font-size: 18px;font-weight: bold;" id="th">
            <td>ID</td>
            <td>LOGO</td>
            <td>商品名称</td>
            <td>货号</td>
            <td>商品分类</td>
            <td>品牌</td>
<!--            <td>市场价</td>-->
            <td>本店价</td>
            <td>库存数量</td>
            <td>商品状态</td>
            <td>排序</td>
<!--            <td>添加时间</td>-->
            <td>操作</td>
        </tr>

        <?php foreach ($goods as $good):?>
            <tr>
                <td><?=$good->id ?></td>
                <td><?=\yii\bootstrap\Html::img($good->logo,['height'=>'30px']) ?></td>
                <td><?=$good->name ?></td>
                <td><?=$good->sn ?></td>
                <td><?=$good->CateName ?></td>
                <td><?=\yii\bootstrap\Html::img('/'.$good->BrandLogo,['height'=>'30px']) ?></td>
<!--                <td>$good->market_price/td>-->
                <td><?=$good->price ?></td>
                <td><?=$good->stock ?></td>
                <td><?=$good->statuss ?></td>
                <td><?=$good->sort ?></td>
<!--               <td>//=date('Y-m-d H:s:i',$good->create_at)</td>-->
                <td>
                    <?php
                    echo \yii\bootstrap\Html::a('修改',['goods/edit?id='.$good->id],['class'=>'btn btn-info']);
                    echo "&nbsp;";
                    echo \yii\bootstrap\Html::a('删除',['goods/del?id='.$good->id],['class'=>'btn btn-danger']);
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