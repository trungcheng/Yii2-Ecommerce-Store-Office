<?php
	use \yii\helpers\Html;
?>
<div class="container page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        	<h1>Quản lý khách hàng</h1><br>
			<?php if(Yii::$app->session->hasFlash('success')){ ?>
		        <div class="alert alert-success" id="flash" align="center" role="alert">
		            <?= Yii::$app->session->getFlash('success') ?>
		        </div>
		    <?php } ?>
        	<br>
        		<?= Html::a("<i class='glyphicon glyphicon-plus'></i> Thêm mới", ['/admin/user/them'], ['class'=>'btn btn-primary']) ?>
        		<?= Html::a("<i class='glyphicon glyphicon-refresh'></i> Làm mới", ['/admin/user/index'], ['class'=>'btn btn-success']) ?>
			<table class="table table-hover table-bordered" style="margin-top:20px;">
				<thead>
					<th style="text-align:center;">#</th>
					<th style="text-align:center;">Email</th>
					<th style="text-align:center;">Tên khách hàng</th>
					<th style="text-align:center;">Địa chỉ nhà</th>
					<th style="text-align:center;">Địa chỉ giao hàng</th>
					<th style="text-align:center;">Số điện thoại</th>
					<th style="text-align:center;"></th>
					<th style="text-align:center;">Chức năng</th>
				</thead>
				<tbody style="text-align:center;">
					<?php
						foreach ($model as $rows) {
							?>
							<tr>
								<td><?= $rows->user_id ?></td>
								<td><?= $rows->email ?></td>
								<td><?= $rows->name ?></td>
								<td><?= $rows->address ?></td>
								<td><?= $rows->ship_address ?></td>
								<td><?= $rows->phone ?></td>
								<td><span style="color:red;">
									<?php
										if($rows->password != 'null'){
											echo "Thành viên";
										}else{
											echo "Khách";
										}
									?>
								</span></td>
								<td>
									<?= Html::a("<i class='glyphicon glyphicon-pencil'></i>", ['/admin/user/sua','id'=>$rows->user_id], ['title'=>'Sửa']) ?>
									<a href="<?= Yii::$app->homeUrl ?>admin/user/delete?id=<?= $rows->user_id ?>" onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa khách hàng này !')" title="Xóa"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
							<?php
						}
					?>
				</tbody>
			</table>
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