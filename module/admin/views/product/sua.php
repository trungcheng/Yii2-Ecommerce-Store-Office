<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<div class="container page-wrapper">
    <div class="row">
        <div class="col-lg-5">
            <h1>Sửa sản phẩm</h1><br>
                <?php $form = ActiveForm::begin(['id' => 'contact-form', 'options' => ['enctype'=>'multipart/form-data']]); ?>

                    <?= $form->field($newPro, 'cat_id')->dropDownList(
                    ArrayHelper::map($ltCate,'cat_id','name'),['prompt' => 'Chọn một danh mục...']) ?>

                    <?= $form->field($newPro, 'name') ?>

                    <?= $form->field($newPro, 'description')->textArea(['rows' => 7]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Cập nhật', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

        </div>
        <div class="col-lg-5"><h1 style="opacity:0;">.</h1><br>

                    <?= $form->field($newPro, 'price') ?>

                    <?= $form->field($newPro, 'discount') ?>

                    <?= $form->field($newPro, 'status') ?>

                    <img src="<?= Yii::$app->homeUrl.$newPro->image ?>" width="100px" height="100px" /> <?= $form->field($newPro, 'fileEdit')->fileInput() ?>

                <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
