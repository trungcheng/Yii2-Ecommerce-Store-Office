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

        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Xác nhận', ['class' => 'btn btn-success btn-block btn-flat', 'name' => 'login-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
</div>

