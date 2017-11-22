<!-- 商品页面主体 start -->
<div class="main w1210 mt10 bc">
    <?php foreach ($goods as $good):?>
    <!-- 面包屑导航 start -->
    <div class="breadcrumb">
<!--        $good->CateParent -->
        <h2>当前位置：<a href="">首页</a> > <?=\yii\helpers\Html::a($good->CateParent->name,['list','id'=>$good->CateParent->id])?> > <?=\yii\helpers\Html::a($good->CateName->name,['list','id'=>$good->CateName->id])?> > <?=$good->name;?></h2>
    </div>
    <!-- 面包屑导航 end -->

    <!-- 主体页面左侧内容 start -->
    <?php include_once Yii::getAlias('@app/views/common/goods_left.php');?>
    <!-- 主体页面左侧内容 end -->

    <!-- 商品信息内容 start -->
    <div class="goods_content fl mt10 ml10">
        <!-- 商品概要信息(summary) start -->
        <?php include_once Yii::getAlias('@app/views/common/goodssummary.php');?>
        <!-- 商品概要信息 end -->

        <div style="clear:both;"></div>

        <!-- 商品详情(goodsdetail) start -->
        <?php include_once Yii::getAlias('@app/views/common/goodsdetail.php');?>
        <!-- 商品详情 end -->


    </div>
    <!-- 商品信息内容 end -->

    <?php endforeach;?>

</div>
<!-- 商品页面主体 end -->