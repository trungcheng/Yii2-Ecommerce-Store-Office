<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Liên hệ với chúng tôi';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    iframe{
        padding-top:25px;
        padding-left: 15px;
        width:100%;
    }
</style>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(Yii::$app->session->hasFlash('success')){ ?>
        <div class="alert alert-success" id="flash" align="center" role="alert">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php } ?>
    <?php if(Yii::$app->session->hasFlash('error')){ ?>
        <div class="alert alert-danger" id="flash" align="center" role="alert">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php } ?>


        <div class="row">
            <div class="col-lg-6 col-lg-6-offset-1">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'name') ?>

                    <?= $form->field($model, 'email')->textInput(['readonly' => true, 'value' => 'trungs1bmt@gmail.com']) ?>

                    <?= $form->field($model, 'subject')->textInput(['readonly' => true, 'value' => 'Khách hàng VPP2000']) ?>

                    <?= $form->field($model, 'body')->textArea(['rows' => 6,'placeholder'=>'Soạn nội dung muốn gửi và nhớ... Để lại EMAIL của bạn ở đây...']) ?>

                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-4">{image}</div><div class="col-lg-5">{input}</div></div>',
                    ]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Gửi ngay', ['class' => 'btn btn-success', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
            <div class="col-lg-5">
                <iframe width="500px"
                  height="455px"
                  frameborder="0" style="border:0"
                  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBmQlUJR1k11TOD_41EMGSjwnToxR7QIfM
                    &q=VP5+Linhdam+Hanoi,Vietnam" allowfullscreen>
                </iframe>
            </div>

        </div>

</div>
<script src="<?= Yii::$app->homeUrl ?>js/jquery.js"></script>
<script>
  $(document).ready(function(){
    $("#flash").delay(3000).fadeOut();
  });
</script>
