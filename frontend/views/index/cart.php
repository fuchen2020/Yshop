
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>购物车页面</title>
    <link rel="stylesheet" href="/style/base.css" type="text/css">
    <link rel="stylesheet" href="/style/global.css" type="text/css">
    <link rel="stylesheet" href="/style/header.css" type="text/css">
    <link rel="stylesheet" href="/style/cart.css" type="text/css">
    <link rel="stylesheet" href="/style/footer.css" type="text/css">

    <script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/js/cart1.js"></script>

</head>
<body>
<!-- 顶部导航 start -->
<?php include_once Yii::getAlias('@app/views/common/topnav.php');?>
<!-- 顶部导航 end -->

<div style="clear:both;"></div>

<!-- 页面头部 start -->
<div class="header w990 bc mt15">
    <div class="logo w990">
        <h2 class="fl"><?=\yii\helpers\Html::a(\yii\bootstrap\Html::img('@web/images/logo.png'),['index/index'])?></a></h2>
        <div class="flow fr">
            <ul>
                <li class="cur">1.我的购物车</li>
                <li>2.填写核对订单信息</li>
                <li>3.成功提交订单</li>
            </ul>
        </div>
    </div>
</div>
<!-- 页面头部 end -->

<div style="clear:both;"></div>

<!-- 主体部分 start -->
<div class="mycart w990 mt10 bc">
    <h2><span>我的购物车</span></h2>
    <table>
        <thead>
        <tr>
            <th class="col1">商品名称</th>
            <th class="col3">单价</th>
            <th class="col4">数量</th>
            <th class="col5">小计</th>
            <th class="col6">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($goodss as $good):?>
        <tr id="<?=$good['id'];?>">
            <td class="col1"><?=\yii\helpers\Html::a(\yii\helpers\Html::img($good['logo']),['goods','g_id'=>$good['id']])?>  <strong><?=\yii\helpers\Html::a($good['name'],['goods','g_id'=>$good['id']])?></strong></td>
            <td class="col3">￥<span><?=$good['price'];?></span></td>
            <td class="col4">
                <a href="javascript:;" class="reduce_num"></a>
                <input type="hidden" id="csrf" value="<?=Yii::$app->request->csrfToken;?>"/>
                <input type="text" name="amount" value="<?=$good['amount']?>" class="amount"/>
                <a href="javascript:;" class="add_num"></a>
            </td>
            <td class="col5">￥<span><?=$good['price']*$good['amount']?></span></td>
            <td class="col6"><a href="javascript:;" class="btn_del">删除</a></td>
        </tr>
        <?php endforeach;?>

        </tbody>
        <tfoot>
        <tr>
            <td colspan="6">购物金额总计： <strong>￥ <span id="total">0.00</span></strong></td>
        </tr>
        </tfoot>
    </table>
    <div class="cart_btn w990 bc mt10">
        <a href="" class="continue">继续购物</a>
<!--        <a href="" class="checkout">结 算</a>-->
        <?php
             echo \yii\helpers\Html::a('结算',['order/index'],['class'=>"checkout"]);
        ?>
    </div>
</div>
<!-- 主体部分 end -->

<div style="clear:both;"></div>
<!-- 底部版权 start -->
<?php include_once Yii::getAlias('@app/views/common/footer.php')?>
<!-- 底部版权 end -->

<script>
    //总计金额(页面打开立即执行)
    var total = 0;
    $(".col5 span").each(function(){
        total += parseFloat($(this).text());
    });
    $("#total").text(total.toFixed(2));

</script>
</body>
</html>

