<div class="floor1 floor w1210 bc mt10">
    <!-- 1F 左侧 start -->
    <div class="floor_left fl">
        <!-- 商品分类信息 start-->
        <div class="cate fl">
            <h2>电脑、办公</h2>
            <div class="cate_wrap">
                <ul>
                    <li><a href=""><b>.</b>外设产品</a></li>
                    <li><a href=""><b>.</b>鼠标</a></li>
                    <li><a href=""><b>.</b>笔记本</a></li>
                    <li><a href=""><b>.</b>超极本</a></li>
                    <li><a href=""><b>.</b>平板电脑</a></li>
                    <li><a href=""><b>.</b>主板</a></li>
                    <li><a href=""><b>.</b>显卡</a></li>
                    <li><a href=""><b>.</b>打印机</a></li>
                    <li><a href=""><b>.</b>一体机</a></li>
                    <li><a href=""><b>.</b>投影机</a></li>
                    <li><a href=""><b>.</b>路由器</a></li>
                    <li><a href=""><b>.</b>网卡</a></li>
                    <li><a href=""><b>.</b>交换机</a></li>
                </ul>
                <p><a href=""><?=\yii\bootstrap\Html::img('@web/images/notebook.jpg')?></a></p>
            </div>


        </div>
        <!-- 商品分类信息 end-->

        <!-- 商品列表信息 start-->
        <div class="goodslist fl">
            <h2>
                <span class="on">推荐商品</span>
                <span>精品</span>
                <span>热卖</span>
            </h2>
            <div class="goodslist_wrap">
                <!-- 推荐商品-->
                <div>
                    <ul>
                        <?php foreach ($xiaomi as $xiao):?>
                            <li>
                                <dl>
                                    <dt><?=\yii\helpers\Html::a(\yii\helpers\Html::img($xiao->logo),['index/goods','g_id'=>$xiao->id])?></dt>
                                    <dd><?=\yii\helpers\Html::a(mb_substr($xiao->name,0,18),['index/goods','g_id'=>$xiao->id])?></dd>
                                    <dd><span>售价：</span><strong> ￥<?=$xiao->price;?></strong></dd>
                                </dl>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <!--精品-->
                <div class="none">
                    <ul>
                        <?php foreach ($jinpins as $jinpin):?>
                            <li>
                                <dl>
                                    <dt><?=\yii\helpers\Html::a(\yii\helpers\Html::img($jinpin->logo),['index/goods','g_id'=>$jinpin->id])?></dt>
                                    <dd><?=\yii\helpers\Html::a(mb_substr($jinpin->name,0,18),['index/goods','g_id'=>$jinpin->id])?></a></dd>
                                    <dd><span>售价：</span><strong> ￥<?=$jinpin->price;?></strong></dd>
                                </dl>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <!--热卖-->
                <div class="none">
                    <ul>
                        <?php foreach ($xiaomi as $xiao):?>
                            <li>
                                <dl>
                                    <dt><?=\yii\helpers\Html::a(\yii\helpers\Html::img($xiao->logo),['index/goods','g_id'=>$xiao->id])?></dt>
                                    <dd><?=\yii\helpers\Html::a(mb_substr($xiao->name,0,18),['index/goods','g_id'=>$xiao->id])?></dd>
                                    <dd><span>售价：</span><strong> ￥<?=$xiao->price;?></strong></dd>
                                </dl>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            </div>
        </div>
        <!-- 商品列表信息 end-->
    </div>
    <!-- 1F 左侧 end -->

    <!-- 右侧 start -->
    <div class="sidebar fl ml10">
        <!-- 品牌旗舰店 start -->
        <div class="brand">
            <h2><a href="">更多品牌&nbsp;></a><strong>品牌旗舰店</strong></h2>
            <div class="sidebar_wrap">
                <ul>
                    <li><a href=""><?=\yii\bootstrap\Html::img('@web/images/dell.gif')?></a></li>
                    <li><a href=""><?=\yii\bootstrap\Html::img('@web/images/acer.gif')?></a></li>
                    <li><a href=""><?=\yii\bootstrap\Html::img('@web/images/fujitsu.jpg')?></a></li>
                    <li><a href=""><?=\yii\bootstrap\Html::img('@web/images/hp.jpg')?></a></li>
                    <li><a href=""><?=\yii\bootstrap\Html::img('@web/images/lenove.jpg')?></a></li>
                    <li><a href=""><?=\yii\bootstrap\Html::img('@web/images/samsung.gif')?></a></li>
                    <li><a href=""><?=\yii\bootstrap\Html::img('@web/images/dlink.gif')?></a></li>
                    <li><a href=""><?=\yii\bootstrap\Html::img('@web/images/seagate.jpg')?></a></li>
                    <li><a href=""><?=\yii\bootstrap\Html::img('@web/images/intel.jpg')?></a></li>
                </ul>
            </div>
        </div>
        <!-- 品牌旗舰店 end -->

        <!-- 分类资讯 start -->
        <div class="info mt10">
            <h2><strong>分类资讯</strong></h2>
            <div class="sidebar_wrap">
                <ul>
                    <li><a href=""><b>.</b>iphone 5s土豪金大量到货</a></li>
                    <li><a href=""><b>.</b>三星note 3低价促销</a></li>
                    <li><a href=""><b>.</b>thinkpad x240即将上市</a></li>
                    <li><a href=""><b>.</b>双十一来临，众商家血拼</a></li>
                </ul>
            </div>

        </div>
        <!-- 分类资讯 end -->

        <!-- 广告 start -->
        <div class="ads mt10">
            <a href=""><?=\yii\bootstrap\Html::img('@web/images/canon.jpg')?></a>
        </div>
        <!-- 广告 end -->
    </div>
    <!-- 右侧 end -->

</div>