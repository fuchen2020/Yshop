<!-- 商品概要信息(summary) start -->
<div class="summary">
    <h3><strong><?=$good->name ;?></strong></h3>
    <!-- 图片预览区域 start -->
    <div class="preview fl">
        <div class="midpic">
            <a href="<?=$good->Imgs[0]['img'].'?imageView2/1/w/800/h/800';?>" class="jqzoom" rel="gal1">   <!-- 第一幅图片的大图 class 和 rel属性不能更改 -->
                <img src="<?=$good->Imgs[0]['img'].'?imageView2/1/w/350/h/350';?>" alt="" />               <!-- 第一幅图片的中图 -->
            </a>
        </div>

        <!--使用说明：此处的预览图效果有三种类型的图片，大图，中图，和小图，取得图片之后，分配到模板的时候，把第一幅图片分配到 上面的midpic 中，其中大图分配到 a 标签的href属性，中图分配到 img 的src上。 下面的smallpic 则表示小图区域，格式固定，在 a 标签的 rel属性中，分别指定了中图（smallimage）和大图（largeimage），img标签则显示小图，按此格式循环生成即可，但在第一个li上，要加上cur类，同时在第一个li 的a标签中，添加类 zoomThumbActive  -->

        <div class="smallpic">
            <a href="javascript:;" id="backward" class="off"></a>
            <a href="javascript:;" id="forward" class="on"></a>
            <div class="smallpic_wrap">
                <ul>
                    <?php foreach ($good->Imgs as $k=>$img):?>
                    <li <?=$k?'':'class="cur"';?>>
                        <a <?= $k?'':'class="zoomThumbActive"';?> href="javascript:void(0);" rel="{gallery: 'gal1', smallimage: '<?=$img['img'].'?imageView2/1/w/350/h/350';?>',largeimage: '<?=$img['img'].'?imageView2/1/w/800/h/800';?>'}"><img src="<?=$img['img'].'?imageView2/1/w/50/h/50';?>"></a>
                    </li>
                    <?php endforeach;?>
                </ul>
            </div>

        </div>

    </div>

    <!-- 图片预览区域 end -->

    <!-- 商品基本信息区域 start -->
    <div class="goodsinfo fl ml10">
        <ul>
            <li><span>商品编号： </span><?=$good->sn ;?></li>
            <li class="market_price"><span>定价：</span><em>￥<?=$good->market_price ;?></em></li>
            <li class="shop_price"><span>本店价：</span> <strong>￥<?=$good->price ;?></strong> <a href="">(降价通知)</a></li>
            <li><span>上架时间：</span><?= date('Y-m-d H:i:s',$good->create_at) ;?></li>
            <li class="star"><span>商品评分：</span> <strong></strong><a href="">(已有21人评价)</a></li> <!-- 此处的星级切换css即可 默认为5星 star4 表示4星 star3 表示3星 star2表示2星 star1表示1星 -->
        </ul>
        <form action="add-cart" method="get" class="choose">
            <ul>
                <li>
                    <dl>
                        <dt>购买数量：</dt>
                        <dd>
                            <a href="javascript:;" id="reduce_num"></a>
                            <input type="text" name="g_id" value="<?=$good->id ;?>"/>
                            <input type="text" name="amount" value="1" class="amount"/>
                            <a href="javascript:;" id="add_num"></a>
                        </dd>
                    </dl>
                </li>

                <li>
                    <dl>
                        <dt>&nbsp;</dt>
                        <dd>
                            <input type="submit" value="" class="add_btn" />
                        </dd>
                    </dl>
                </li>

            </ul>
        </form>
    </div>
    <!-- 商品基本信息区域 end -->
</div>
<!-- 商品概要信息 end -->