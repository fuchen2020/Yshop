
<div class="user fl">
    <dl>
        <dt>
            <em></em>
            <a href="">用户中心</a>
            <b></b>
        </dt>
        <dd>
            <div class="prompt">
                您好， <?php
                if (Yii::$app->user->isGuest) {
                    echo '[<a href="login">登录</a>]';
                } else {
                    echo  '<span style="font-size: 18px;color:royalblue;">'.Yii::$app->user->identity->username.'</span>';
                } ?>
                        </div>
                        <div class="uclist mt10">
                            <ul class="list1 fl">
                                <li><a href="">用户信息></a></li>
                                <li><a href="">我的订单></a></li>
                                <li>
                                    <?=\yii\bootstrap\Html::a('收货地址',['address/index']);?>
                                </li>
                                <li><a href="">我的收藏></a></li>
                            </ul>

                            <ul class="fl">
                                <li><a href="">我的留言></a></li>
                                <li><a href="">我的红包></a></li>
                                <li><a href="">我的评论></a></li>
                                <li><a href="">资金管理></a></li>
                            </ul>

                        </div>
                        <div style="clear:both;"></div>
                        <div class="viewlist mt10">
                            <h3>最近浏览的商品：</h3>
                            <ul>
                                <li><a href=""><img src="/images/view_list1.jpg"></a></li>
                                <li><a href=""><img src="/images/view_list2.jpg"></a></li>
                                <li><a href=""><img src="/images/view_list3.jpg"></a></li>

                            </ul>
                        </div>
                    </dd>
    </dl>
</div>
