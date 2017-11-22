
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>填写核对订单信息</title>
    <link rel="stylesheet" href="/style/base.css" type="text/css">
    <link rel="stylesheet" href="/style/global.css" type="text/css">
    <link rel="stylesheet" href="/style/header.css" type="text/css">
    <link rel="stylesheet" href="/style/fillin.css" type="text/css">
    <link rel="stylesheet" href="/style/footer.css" type="text/css">

    <script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/js/cart2.js"></script>

</head>
<body>
<!-- 顶部导航 start -->
<?php include_once Yii::getAlias('@app/views/common/topnav.php');?>
<!-- 顶部导航 end -->

<div style="clear:both;"></div>

<!-- 页面头部 start -->
<div class="header w990 bc mt15">
    <div class="logo w990">
        <h2 class="fl"><?=\yii\helpers\Html::a(\yii\bootstrap\Html::img('@web/images/logo.png'),['index/index'])?></h2>
        <div class="flow fr flow2">
            <ul>
                <li>1.我的购物车</li>
                <li class="cur">2.填写核对订单信息</li>
                <li>3.成功提交订单</li>
            </ul>
        </div>
    </div>
</div>
<!-- 页面头部 end -->

<div style="clear:both;"></div>
<form action="<?=\yii\helpers\Url::to(['order/order'])?>" method="post">
    <input type="hidden" id="_csrf-frontend" value="<?=Yii::$app->request->csrfToken;?>"/>
<!-- 主体部分 start -->
<div class="fillin w990 bc mt15">
    <div class="fillin_hd">
        <h2>填写并核对订单信息</h2>
    </div>

    <div class="fillin_bd">
        <!-- 收货人信息  start-->
        <div class="address">
            <h3>收货人信息 <a href="javascript:;" id="address_modify">[修改]</a></h3>
            <div class="address_info">
                <p>
                    <?php foreach ($ress as $res):?>
                    <input type="radio" value="<?=$res->id;?>"  <?=$res->id==$default_address?'checked="checked"':'';?>  name="address_id"/><?=$res->consignee;?> <?=$res->tel;?> <?=$res->province;?> <?=$res->city;?> <?=$res->county;?> <?=$res->detailed_address;?> </p>
                    <?php endforeach;?>
            </div>
        </div>
        <!-- 收货人信息  end-->

        <!-- 配送方式 start -->
        <div class="delivery">
            <h3>送货方式 <a href="javascript:;" id="delivery_modify">[修改]</a></h3>
            <div class="delivery_info">
                <?php foreach ($express as $k=>$ex):?>
                <p><input type="radio" name="express_id"  <?= $k==3?'checked="checked"':'';?>   class="express" value="<?=$k;?>" price="<?=$ex['express_price']?>"/><?=$ex['express_name']?></p>
                <?php endforeach;?>
            </div>

        </div>
        <!-- 配送方式 end -->

        <!-- 支付方式  start-->
        <div class="pay">
            <h3>支付方式 <a href="javascript:;" id="pay_modify">[修改]</a></h3>
            <div class="pay_info">
                <?php foreach ($pay_type as $id=>$pname):?>
                <p><input type="radio" name="pay_type_id" checked="checked" value="<?=$id?>" /><?=$pname?></p>
                <?php endforeach;?>
            </div>

            <div class="pay_select none">
                <table>
                    <tr class="cur">
                        <td class="col1"><input type="radio" name="pay" />货到付款</td>
                        <td class="col2">送货上门后再收款，支持现金、POS机刷卡、支票支付</td>
                    </tr>
                    <tr>
                        <td class="col1"><input type="radio" name="pay" />在线支付</td>
                        <td class="col2">即时到帐，支持绝大数银行借记卡及部分银行信用卡</td>
                    </tr>
                    <tr>
                        <td class="col1"><input type="radio" name="pay" />上门自提</td>
                        <td class="col2">自提时付款，支持现金、POS刷卡、支票支付</td>
                    </tr>
                    <tr>
                        <td class="col1"><input type="radio" name="pay" />邮局汇款</td>
                        <td class="col2">通过快钱平台收款 汇款后1-3个工作日到账</td>
                    </tr>
                </table>
                <a href="" class="confirm_btn"><span>确认支付方式</span></a>
            </div>
        </div>
        <!-- 支付方式  end-->

        <!-- 发票信息 start-->
        <!-- 发票信息 end-->

        <!-- 商品清单 start -->
        <div class="goods">
            <h3>商品清单</h3>
            <table>
                <thead>
                <tr>
                    <th class="col1">商品</th>
                    <th class="col3">价格</th>
                    <th class="col4">数量</th>
                    <th class="col5">小计</th>
                </tr>
                </thead>
                <tbody>
                <?php $total_amount='';$total_price='';?>
                <?php foreach ($goods as $good):?>
                <tr>
                    <td class="col1"><?=\yii\helpers\Html::a(\yii\helpers\Html::img($good['logo']),['goods','g_id'=>$good['id']])?>  <strong><?=\yii\helpers\Html::a($good['name'],['goods','g_id'=>$good['id']])?></strong></td>
                    <td class="col3">￥<?=$good['price']?></td>
                    <td class="col4"> <?=$good['amount']?></td>
                    <?php $total_amount +=$good['amount'];?>
                    <td class="col5"><span>￥<?=$good['price']*$good['amount']?></span></td>
                    <?php $total_price +=$good['price']*$good['amount'];?>
                </tr>
                <?php endforeach;?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5">
                        <ul>
                            <li>
                                <span><?=$total_amount;?> 件商品，总商品金额：</span>
                                <em>￥<span id="zong"><?=$total_price;?></span></em>
                            </li>
                            <li>
                                <span>返现：</span>
                                <em>-￥0.00</em>
                            </li>
                            <li>
                                <span>运费：</span>
                                <em>￥<span id="yunfei">20.00</span></em>
                            </li>
                            <li>
                                <span>应付总额：</span>
                                <em>￥<span class="yinfu"><?=$total_price+20;?></span></em>
                            </li>
                        </ul>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- 商品清单 end -->

    </div>

    <div class="fillin_ft">
<!--        <a href=""><span>提交订单</span></a>-->

        <button type="submit" class="bbtn"><span>提交订单</span></button>
        <p>应付总额：<strong>￥<span class="yinfu"><?=$total_price+20;?></span>元</strong></p>

    </div>
</div>
<!-- 主体部分 end -->
</form>
<div style="clear:both;"></div>
<!-- 底部版权 start -->
<?php include_once Yii::getAlias('@app/views/common/footer.php')?>
<!-- 底部版权 end -->
</body>
</html>
