<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($goods,'name');
echo $form->field($goods,'sn');
echo $form->field($goods,'goods_category_id')->dropDownList($cate);
echo $form->field($goods,'brand_id')->dropDownList($brand);
echo $form->field($goods,'market_price');
echo $form->field($goods,'price');
echo $form->field($goods,'stock');
echo $form->field($goods,'status')->inline()->radioList(\backend\models\Goods::$statu);
echo $form->field($goods,'sort');
echo $form->field($goods, 'logo')->widget('manks\FileInput', []);
echo $form->field($goods, 'imgPath')->widget('manks\FileInput', [
    'clientOptions' => [
        'pick' => [
            'multiple' => true,
        ],
//        'server' => \yii\helpers\Url::to(['upload']),
        'accept' => [
            'extensions' => ['png','jpg','gif'],
        ],
    ],
]);
//echo $form->field($goodsDetails,'content')->textarea();
echo $form->field($goodsDetails,'content')->widget('kucha\ueditor\UEditor',[]);

echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-success']);

\yii\bootstrap\ActiveForm::end();