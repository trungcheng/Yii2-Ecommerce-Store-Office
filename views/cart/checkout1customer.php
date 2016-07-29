<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Thanh toán / Thông tin & Địa chỉ giao hàng';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="panel panel-default">
  	<div class="panel-heading">
    	<h3 class="panel-title">1. Thông tin & Địa chỉ giao hàng:</h3>
  	</div>
  	<div class="panel-body">
  
		<?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'email')->textInput(['placeholder'=>'Địa chỉ email của khách hàng']) ?>

                <?= $form->field($model, 'name')->textInput(['placeholder' => "Họ tên khách hàng"]) ?>

                <?= $form->field($model, 'address')->textInput(['placeholder' => "Ví dụ: 36 Nguyễn Trường Tộ - Ba Đình - Hà Nội"]) ?>

                <?= $form->field($model, 'ship_address')->textInput(['placeholder' => "Ví dụ: 36 Nguyễn Trường Tộ - Ba Đình - Hà Nội"]) ?>

                <?= $form->field($model, 'phone')->textInput(['placeholder' => "Số điện thoại di động"]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Xác nhận và tiếp tục', ['class' => 'btn btn-success', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
  	</div>
</div>


