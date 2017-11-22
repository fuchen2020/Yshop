<div class="guide_content fl">
    <h2>
        <span class="on">新品上架</span>
        <span>热卖商品</span>
        <span>精品推荐</span>
    </h2>

    <div class="guide_wrap">
        <!-- 疯狂抢购 start-->
        <div class="crazy">
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
        <!-- 疯狂抢购 end-->

        <!-- 热卖商品 start -->
        <div class="hot none">
            <ul>
                <?php foreach ($hots as $hot):?>
                    <li>
                        <dl>
                            <dt><?=\yii\helpers\Html::a(\yii\helpers\Html::img($hot->logo),['index/goods','g_id'=>$hot->id])?></dt>
                            <dd><?=\yii\helpers\Html::a(mb_substr($hot->name,0,18),['index/goods','g_id'=>$hot->id])?></dd>
                            <dd><span>售价：</span><strong> ￥<?=$hot->price;?></strong></dd>
                        </dl>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!-- 热卖商品 end -->

        <!-- 推荐商品 atart -->
        <div class="recommend none">
            <ul>
                <?php foreach ($xiaomi as $xiao):?>
                    <li>
                        <dl>
                            <dt><?=\yii\helpers\Html::a(\yii\helpers\Html::img($xiao->logo),['index/goods','g_id'=>$xiao->id])?></dt>
                            <dd><?=\yii\helpers\Html::a(mb_substr($xiao->name,0,18),['index/goods','g_id'=>$xiao->id])?></a></dd>
                            <dd><span>售价：</span><strong> ￥<?=$xiao->price;?></strong></dd>
                        </dl>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!-- 推荐商品 end -->

    </div>

</div>