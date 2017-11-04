<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'sort');
echo $form->field($model,'intro')->textarea();
echo $form->field($model,'status')->inline()->radioList(\backend\models\Brand::$status);
//echo $form->field($model,'imgFile')->fileInput();
//图片上传
echo $form->field($model, 'logo')->widget('manks\FileInput', []);
//if($model->logo){
//    echo \yii\bootstrap\Html::img('/'.$model->logo,['height'=>'60px']);
//    echo '</br>';
//    echo '</br>';
//    echo \yii\bootstrap\Html::submitButton('修改品牌',['class'=>'btn btn-success']);
//}else{
    echo \yii\bootstrap\Html::submitButton('添加品牌',['class'=>'btn btn-success']);
//}

\yii\bootstrap\ActiveForm::end();