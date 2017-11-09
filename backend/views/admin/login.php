<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '后台登陆';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-3">
            <h1>&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-user"></span></span><?= Html::encode($this->title) ?></h1>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'rememberMe')->checkbox()?>
            <div class="form-group ">
              <?= Html::submitButton('管理员登陆', ['class' => 'btn btn-primary', 'name' => 'login-button', 'style'=>'margin-left:80px']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div style="margin-left: "></div>

</div>

</div>

