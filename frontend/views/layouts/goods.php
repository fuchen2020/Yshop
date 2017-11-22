<?php
\frontend\assets\GoodsAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>商品页面</title>
    <script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/js/header.js"></script>
    <script type="text/javascript" src="/js/goods.js"></script>
    <script type="text/javascript" src="/js/jqzoom-core.js"></script>

    <?php $this->head() ?>
    <!-- jqzoom 效果 -->
    <script type="text/javascript">
        $(function(){
            $('.jqzoom').jqzoom({
                zoomType: 'standard',
                lens:true,
                preloadImages: false,
                alwaysOn:false,
                title:false,
                zoomWidth:400,
                zoomHeight:400
            });
        })
    </script>
</head>
<body>
<?php $this->beginBody() ?>
<!-- 顶部导航 start -->
<?php include_once Yii::getAlias('@app/views/common/topnav.php')?>
<!-- 顶部导航 end -->

<div style="clear:both;"></div>

<!-- 头部 start -->
<?php include_once Yii::getAlias('@app/views/common/header.php')?>
<!-- 头部 end-->

<div style="clear:both;"></div>


<!-- 商品页面主体 start -->
<?= $content ?>
<!-- 商品页面主体 end -->


<div style="clear:both;"></div>

<!-- 底部导航 start -->
<?php include_once Yii::getAlias('@app/views/common/bottomnav.php')?>
<!-- 底部导航 end -->

<div style="clear:both;"></div>
<!-- 底部版权 start -->
<?php include_once Yii::getAlias('@app/views/common/footer.php')?>
<!-- 底部版权 end -->

<script type="text/javascript">
    document.execCommand("BackgroundImageCache", false, true);
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>