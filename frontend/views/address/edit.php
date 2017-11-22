<?php
/* @var $this yii\web\View */
?>
<div class="content fl ml10">

    <div class="address_bd mt10">
        <h4>修改收货地址</h4>
        <form action="edit?id=<?=$ress['id']?>" name="address_form" method="post">
            <ul>
                <li>
                    <label for=""><span>*</span>收 货 人：</label>
                    <input type="hidden" name="Address[id]" value="<?=$ress['id']?>"/>
                    <input type="hidden" name="Address[users_id]" value="<?=$ress['users_id']?>"/>
                    <input type="text" name="Address[consignee]" class="txt"  value="<?=$ress['consignee']?>"/>
                </li>
                <li>
                    <label for=""><span>*</span>所在地区：</label>
                    <select name="Address[province]" id="province" onchange="doProvAndCityRelation();">
                        <option id="choosePro" value="-1"><?=$ress['province']?></option>
                    </select>

                    <select name="Address[city]" id="citys" onchange="doCityAndCountyRelation();">
                        <option id='chooseCity' value='-1'><?=$ress['city']?></option>
                    </select>

                    <select name="Address[county]" id="county">
                        <option id='chooseCounty' value='-1'><?=$ress['county']?></option>
                    </select>
                </li>
                <li>
                    <label for=""><span>*</span>详细地址：</label>
                    <input type="text" name="Address[detailed_address]" class="txt address"  value="<?=$ress['detailed_address']?>"/>
                </li>
                <li>
                    <label for=""><span>*</span>手机号码：</label>
                    <input type="text" name="Address[tel]" class="txt" value="<?=$ress['tel']?>"/>
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