<?php

\frontend\assets\Index::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <?php $this->head() ?>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>京西会所</title>
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
<!--内容区-->
    <?= $content ?>
<!--内容区结束-->
    <div style="clear:both;"></div>

    <!-- 底部导航 start -->
    <?php include_once Yii::getAlias('@app/views/common/bottomnav.php')?>
    <!-- 底部导航 end -->

    <div style="clear:both;"></div>
    <!-- 底部版权 start -->
    <?php include_once Yii::getAlias('@app/views/common/footer.php')?>
    <!-- 底部版权 end -->
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>