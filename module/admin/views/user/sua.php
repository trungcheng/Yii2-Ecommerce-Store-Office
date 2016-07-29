<?php
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
	use yii\captcha\Captcha;
?>
<div class="container page-wrapper">
    <div class="row">
        <div class="col-lg-5">
        	<h1>Cập nhật khách hàng</h1><br>
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true,'placeholder'=>'Địa chỉ email của khách hàng']) ?>

                <?= $form->field($model, 'name')->textInput(['placeholder' => "Họ tên khách hàng"]) ?>

                <?= $form->field($model, 'address')->textInput(['placeholder' => "Ví dụ: 36 Nguyễn Trường Tộ - Ba Đình - Hà Nội"]) ?>

                <?= $form->field($model, 'ship_address')->textInput(['placeholder' => "Ví dụ: 36 Nguyễn Trường Tộ - Ba Đình - Hà Nội"]) ?>

                <?= $form->field($model, 'phone')->textInput(['placeholder' => "Số điện thoại di động"]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Cập nhật', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
	</div>
</div>