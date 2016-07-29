<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */
?>
    <?php if(Yii::$app->session->hasFlash('error')){ ?>
    <div class="alert alert-danger" id="flash" align="center" role="alert">
        <?= Yii::$app->session->getFlash('error') ?>
    </div>
    <?php } ?>
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>
                
                <?= $form->field($model, 'confirmPassword')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Đăng ký', ['class' => 'btn btn-success btn-block btn-flat', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
<script src="<?= Yii::$app->homeUrl ?>js/jquery.js"></script>
<script>
  $(document).ready(function(){
    $("#flash").delay(3000).fadeOut();
  });
</script>