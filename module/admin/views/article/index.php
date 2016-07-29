<?php
	use \yii\helpers\Html;
	use yii\widgets\LinkPager;
?>
<div class="container page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        	<h1>Quản lý bài viết</h1><br>
        	<?php if(Yii::$app->session->hasFlash('success')){ ?>
		        <div class="alert alert-success" id="flash" align="center" role="alert">
		            <?= Yii::$app->session->getFlash('success') ?>
		        </div>
		    <?php } ?>
        	<p><?= Html::a("<i class='glyphicon glyphicon-plus'></i> Thêm mới", ['/admin/article/them'], ['class'=>'btn btn-primary']) ?>
			<?= Html::a("<i class='glyphicon glyphicon-refresh'></i> Làm mới", ['/admin/article/index'], ['class'=>'btn btn-success']) ?></p>
			<table class="table table-hover table-bordered" style="margin-top:20px;">
				<thead>
					<th style="text-align:center;">#</th>
					<th style="text-align:center;">Ảnh chính</th>
					<th style="text-align:center;">Tiêu đề</th>
					<th style="text-align:center;">Mô tả ngắn</th>
					<th style="text-align:center;">Nội dung bài viết</th>
					<th style="text-align:center;">Hành động</th>
				</thead>
				<tbody style="text-align:center;">
					<?php
						foreach ($models as $rows) {
					?>
							<tr>
								<td><?= $rows->news_id ?></td>
								<td><img src="<?= Yii::$app->homeUrl ?><?= $rows->news_image ?>" width="70" heihgt="70"></td>
								<td><?= $rows->news_title ?></td>
								<td><?= $rows->news_short_desc ?></td>
								<td><?= $rows->news_content ?></td>
								<td>
									<?= Html::a("<i class='glyphicon glyphicon-pencil'></i>", ['/admin/article/sua','id'=>$rows->news_id], ['title'=>'Sửa']) ?>
									<a href="<?= Yii::$app->homeUrl ?>admin/article/xoa?id=<?= $rows->news_id ?>" onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa bài viết này !')" title="Xóa"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
							<?php
						}
					?>
				</tbody>
			</table>
			<div style="text-align:right;"><?= LinkPager::widget(['pagination' => $pages]) ?></div>
		</div>
	</div>
</div>
<script src="<?= Yii::$app->homeUrl ?>js/jquery.js"></script>
<script>
	$(document).ready(function(){
		$("#flash").delay(2000).fadeOut();
	})
	function xacnhanxoa(msg){
	    if(window.confirm(msg)){
	        return true;
	    }    
	    return false;
	}
</script>