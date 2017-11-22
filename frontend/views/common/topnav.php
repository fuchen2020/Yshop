<!-- 顶部导航 start -->
<div class="topnav">
    <div class="topnav_bd w1210 bc">
        <div class="topnav_left">

        </div>
        <div class="topnav_right fr">
            <ul>
                <li>您好，欢迎来到京西！
                    <?php
                    if (Yii::$app->user->isGuest) {
                        echo '['.\yii\helpers\Html::a('登陆',['users/login']).'] ['.\yii\helpers\Html::a('免费注册',['users/reg']).']';
                    } else {
                        echo  '<span style="font-size: 18px;color:royalblue;">'.
                            Yii::$app->user->identity->username.'</span>'.'&nbsp;&nbsp;'."[".\yii\bootstrap\Html::a('退出登陆',['users/logout'])."]";
                    }
                    ?>
                </li>
                <li class="line">|</li>
                <li>我的订单</li>
                <li class="line">|</li>
                <li>客户服务</li>

            </ul>
        </div>
    </div>
</div>
<!-- 顶部导航 end -->