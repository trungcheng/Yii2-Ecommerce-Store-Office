<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Tin tức văn phòng';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php foreach($model as $list){ ?>

<div class="col-md-12 wrapper-news">
	<div class="col-md-2 wrapper-img">
		<a href="<?= Yii::$app->homeUrl ?>new/detail?id=<?= $list->news_id ?>" title="<?= $list->news_title ?>">
			<img src="<?= Yii::$app->homeUrl ?><?= $list->news_image ?>" width="130px" height="91px">
		</a>
	</div>
	<div class="col-md-9 col-md-offset-1 wrapper-content">
		<a href="<?= Yii::$app->homeUrl ?>new/detail?id=<?= $list->news_id ?>" title="<?= $list->news_title ?>">
			<p><strong><?= $list->news_title ?></strong></p>
		</a>
		<div class="short-content">
			<?= $list->news_short_desc ?>
		</div>
	</div>
</div>

<?php } ?>
<div style="clear:both;"></div>   
<div class="phantrang2"><?= LinkPager::widget(['pagination' => $pagination]) ?></div>

