<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
?>
<div class="container page-wrapper">
    <div class="row">
        <div class="col-lg-5">
            <h1>Thêm mới sản phẩm</h1><br>
                <?php $form = ActiveForm::begin(['id' => 'contact-form', 'options' => ['enctype'=>'multipart/form-data']]); ?>

                    <?= $form->field($newPro, 'cat_id')->dropDownList(
                    ArrayHelper::map($ltCate,'cat_id','name'),['prompt' => 'Chọn một danh mục...']) ?>

                    <?= $form->field($newPro, 'name') ?>

                    <?= $form->field($newPro, 'description')->textArea(['rows' => 6]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Thêm mới', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

        </div>
        <div class="col-lg-5"><h1 style="opacity:0;">.</h1><br>

                    <?= $form->field($newPro, 'price') ?>

                    <?= $form->field($newPro, 'discount') ?>

                    <?= $form->field($newPro, 'status') ?>

                    <?= $form->field($newPro, 'fileUpload')->fileInput() ?>
                    
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>