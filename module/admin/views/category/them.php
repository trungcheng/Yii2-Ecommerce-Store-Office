<?php
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
	use yii\captcha\Captcha;
?>
<div class="container page-wrapper">
    <div class="row">
        <div class="col-lg-5">
        	<h1>Thêm mới danh mục</h1><br>
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'description')->textArea(['rows' => 6]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Thêm', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
	</div>
</div>