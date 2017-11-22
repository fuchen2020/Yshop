
<!-- 综合区域 start 包括幻灯展示，商城快报（expressnews） -->
<?php include_once Yii::getAlias('@app/views/common/expressnews.php')?>
<!-- -综合区域 end -->

<!--清除浮动-->
<div style="clear:both;"></div>
<!--清除浮动结束-->

<!-- 导购区域 start -->
<div class="guide w1210 bc mt15">
    <!-- 导购左边区域(hot热销，新品，精品) start -->
    <?php include_once Yii::getAlias('@app/views/common/hot.php')?>
    <!-- 导购左边区域(hot) end -->

    <!-- 侧栏 网站首发(文章) start-->
    <?php include_once Yii::getAlias('@app/views/common/article.php')?>
    <!-- 侧栏 网站首发(文章) end -->

</div>
<!-- 导购区域 end -->


<!--清除浮动-->
<div style="clear:both;"></div>
<!--清除浮动结束-->

<!--1F 电脑办公（computerwork） start -->
<?php include_once Yii::getAlias('@app/views/common/computerwork.php')?>
<!--1F 电脑办公 start -->
