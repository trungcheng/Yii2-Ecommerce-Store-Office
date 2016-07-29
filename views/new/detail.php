<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use kartik\social\FacebookPlugin;

$this->title = 'Tin tức văn phòng / '. $model->news_title;
$this->params['breadcrumbs'][] = $this->title;
?>
<?= FacebookPlugin::widget(['type'=>FacebookPlugin::SHARE, 'settings' => ['layout'=>'button']]) ?><br><br>
<strong><?= $model->news_short_desc ?></strong><br>

<div align="justify" style="margin-top:20px;">
	<?= $model->news_content ?>
</div>