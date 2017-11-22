<?php
/* @var $this yii\web\View */
?>
<div class="content fl ml10">
    <div class="address_hd">
        <h3>收货地址薄</h3>
        <?php foreach ($ress as $res):?>
        <dl>
            <dt><?=$res['id']?>.<?=$res->consignee?> <?=$res['province']?> <?=$res['city']?> <?=$res['county']?> <?=$res['detailed_address']?> <?=$res['tel']?> </dt>
            <dd>
                <?php
                 echo \yii\helpers\Html::a('修改',['address/edit?id='.$res['id']]);
                 echo '&nbsp;&nbsp;';
                 echo \yii\helpers\Html::a('删除',['address/del?id='.$res['id']]);
                 echo '&nbsp;&nbsp;';
                 echo \yii\helpers\Html::a('设为默认地址',['address/default?id='.$res['id'].'&u_id='.$res['users_id']]);
                ?>
            </dd>
        </dl>
        <?php endforeach;?>
    </div>

    <div class="address_bd mt10">
        <h4>新增收货地址</h4>
        <form action="add" name="address_form" method="post">
            <ul>
                <li>
                    <label for=""><span>*</span>收 货 人：</label>
                    <input type="hidden" name="Address[users_id]" value="<?=Yii::$app->user->getId()?>"/>
                    <input type="text" name="Address[consignee]" class="txt" />
                </li>
                <li>
                    <label for=""><span>*</span>所在地区：</label>
                    <select name="Address[province]" id="province" onchange="doProvAndCityRelation();">
                        <option id="choosePro" value="-1">请选择省份</option>
                    </select>

                    <select name="Address[city]" id="citys" onchange="doCityAndCountyRelation();">
                        <option id='chooseCity' value='-1'>请选择城市</option>
                    </select>

                    <select name="Address[county]" id="county">
                        <option id='chooseCounty' value='-1'>请选择区/县</option>
                    </select>
                </li>
                <li>
                    <label for=""><span>*</span>详细地址：</label>
                    <input type="text" name="Address[detailed_address]" class="txt address"  />
                </li>
                <li>
                    <label for=""><span>*</span>手机号码：</label>
                    <input type="text" name="Address[tel]" class="txt" />
                </li>
                <li>
                    <label for="">&nbsp;</label>
                    <input type="checkbox" name="Address[default]" class="check" value="1"/>设为默认地址
                </li>
                <li>
                    <label for="">&nbsp;</label>
                    <input type="submit" name="" class="btn" value="保存" />
                </li>
            </ul>
        </form>
    </div>

</div>