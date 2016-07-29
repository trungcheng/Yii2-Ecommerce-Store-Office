<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Xác nhận mật khẩu mới';
$this->params['breadcrumbs'][] = $this->title;
?>
<h2>Xác nhận mật khẩu mới</h2>
<?php if(Yii::$app->session->hasFlash('success')){ ?>
    <div class="alert alert-success" id="flash" align="center" role="alert">
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php } ?>
<div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            	<?= $form->field($model, 'email')->textInput(['autofocus'=>true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>
                
                <?= $form->field($model, 'confirmPassword')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Xác nhận thay đổi', ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
