<?php
	use \yii\helpers\Html;
	use yii\widgets\LinkPager;
?>
<div class="container page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        	<h1>Quản lý sản phẩm</h1><br>
        	<?php if(Yii::$app->session->hasFlash('success')){ ?>
		        <div class="alert alert-success" id="flash" align="center" role="alert">
		            <?= Yii::$app->session->getFlash('success') ?>
		        </div>
		    <?php } ?>
        	<p><?= Html::a("<i class='glyphicon glyphicon-plus'></i> Thêm mới", ['/admin/product/them'], ['class'=>'btn btn-primary']) ?>
			<?= Html::a("<i class='glyphicon glyphicon-refresh'></i> Làm mới", ['/admin/product/index'], ['class'=>'btn btn-success']) ?></p>
			<table class="table table-hover table-bordered" style="margin-top:20px;">
				<thead>
					<th style="text-align:center;">#</th>
					<th style="text-align:center;">Ảnh</th>
					<th style="text-align:center;">Tên sản phẩm</th>
					<th style="text-align:center;">Thuộc danh mục</th>
					<th style="text-align:center;">Mô tả sản phẩm</th>
					<th style="text-align:center;">Giá</th>
					<th style="text-align:center;">Giảm giá (%)</th>
					<th style="text-align:center;">Trạng thái</th>
					<th style="text-align:center;">Hành động</th>
				</thead>
				<tbody style="text-align:center;">
					<?php
						foreach ($models as $rows) {
							foreach ($model as $value) {
								$cat_name = '';
								if($rows->cat_id == $value->cat_id ){
									$cat_name = $value->name;
									break;
								}
							}
							?>
							<tr>
								<td><?= $rows->pro_id ?></td>
								<td><img src="<?= Yii::$app->homeUrl ?><?= $rows->image ?>" width="70" heihgt="70"></td>
								<td><?= $rows->name ?></td>
								<td><?= $cat_name ?></td>
								<td><?= $rows->description ?></td>
								<td><?= $rows->price ?></td>
								<td><?= $rows->discount ?></td>
								<td><?= $rows->status ?></td>
								<td>
									<?= Html::a("<i class='glyphicon glyphicon-pencil'></i>", ['/admin/product/sua','id'=>$rows->pro_id], ['title'=>'Sửa']) ?>
									<a href="<?= Yii::$app->homeUrl ?>admin/product/xoa?id=<?= $rows->pro_id ?>" onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa sản phẩm này !')" title="Xóa"><i class="fa fa-trash"></i></a>
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