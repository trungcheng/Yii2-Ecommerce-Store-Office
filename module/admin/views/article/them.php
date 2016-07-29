<?php
	use yii\widgets\ActiveForm;
	use mihaildev\ckeditor\CKEditor;
	use app\module\admin\models\News;
	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
?>
<div class="container page-wrapper">
    <div class="row">
        <div class="col-lg-8">
        	<h1>Thêm mới bài viết</h1><br>

            <?php $form = ActiveForm::begin(); ?>

            	<?= $form->field($model, 'fileUpload')->fileInput() ?>

                <?= $form->field($model, 'news_title')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'news_short_desc')->textArea(['rows' => 4]) ?>

                <?= $form->field($model, 'news_content')->widget(CKEditor::className(),[
				    'editorOptions' => [
				        'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
				        'inline' => false, //по умолчанию false
				    ],
				]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Thêm mới', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
	</div>
</div>
