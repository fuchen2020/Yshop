<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'type')->dropDownList($options);
echo $form->field($model,'sort');
echo $form->field($model,'status')->inline()->radioList(\backend\models\ArticleCaetgory::$status);
echo $form->field($content,'content')->textarea();
echo \yii\bootstrap\Html::submitButton('添加分类',['class'=>'btn btn-success']);

\yii\bootstrap\ActiveForm::end();