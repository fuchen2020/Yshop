<?php
/* @var $this \yii\web\View */
/* @var $content string */

\frontend\assets\LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <?php $this->head() ?>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>用户注册</title>
</head>
<body>
<?php $this->beginBody() ?>
<!-- 顶部导航 start -->
<?php include_once Yii::getAlias('@app/views/common/topnav.php')?>
<!-- 顶部导航 end -->

<div style="clear:both;"></div>

<!-- 页面头部 start -->
<div class="header w990 bc mt15">
    <div class="logo w990">
        <h2 class="fl"><?=\yii\helpers\Html::a(\yii\bootstrap\Html::img("@web/images/logo.png"),['index/index']);?></h2>
    </div>
</div>
<!-- 页面头部 end -->

<!-- 登录主体部分start -->
<div class="container">
    <?=\dmstr\widgets\Alert::widget()?>
<?= $content ?>2
</div>
<!-- 登录主体部分end -->

<div style="clear:both;"></div>
<!-- 底部版权 start -->
<?php include_once Yii::getAlias('@app/views/common/footer.php')?>
<!-- 底部版权 end -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>