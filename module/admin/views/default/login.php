<?php

/* @var $this yiiebiew */
/* @var $form yiiootstrapctiveForm */
/* @var $model appodelsoginForm */

use yii\helpers\html;
use yii\bootstrap\ActiveForm;
?>
<div class="row">
    <div class="col-lg-12">
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Đăng nhập', ['class' => 'btn btn-success btn-block btn-flat', 'name' => 'login-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
</div>

