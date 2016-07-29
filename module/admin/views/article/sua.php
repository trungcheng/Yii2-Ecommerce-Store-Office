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
        	<h1>Cập nhật bài viết</h1><br>

            <?php $form = ActiveForm::begin(); ?>

            	<img src="<?= Yii::$app->homeUrl.$model->news_image ?>" width="100px" height="100px" /> <?= $form->field($model, 'fileEdit')->fileInput() ?>

                <?= $form->field($model, 'news_title')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'news_short_desc')->textArea(['rows' => 4]) ?>

                <?= $form->field($model, 'news_content')->widget(CKEditor::className(),[
				    'editorOptions' => [
				        'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
				        'inline' => false, //по умолчанию false
				    ],
				]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Cập nhật', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
	</div>
</div>
