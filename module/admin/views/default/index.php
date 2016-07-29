<?php
	use yii\helpers\Html;
	use yii\widgets\LinkPager;
?>
<style>
	.glyphicon{
		cursor: pointer;
	}
</style>
<div class="container page-wrapper">
    <div class="row">
        <div class="col-lg-12" id="users">
        	<h1>Quản lý hóa đơn</h1><br>
			<?php if(Yii::$app->session->hasFlash('success')){ ?>
		        <div class="alert alert-success" id="flash" align="center" role="alert">
		            <?= Yii::$app->session->getFlash('success') ?>
		        </div>
		    <?php } ?>
        	<p>
        		<?= Html::a("<i class='glyphicon glyphicon-plus'></i> Thêm mới", ['/admin/default/them'], ['class'=>'btn btn-primary']) ?>
        		<?= Html::a("<i class='glyphicon glyphicon-refresh'></i> Làm mới", ['/admin/default/index'], ['class'=>'btn btn-success']) ?>
        		<input class="col-md-2 pull-right" id="searchInput" placeholder="Tìm kiếm nhanh">
        	</p>
        	
			<table class="js-dynamitable table table-bordered" style="margin-top:20px;">
				<thead>
					<th style="text-align:center;">#</th>
          				<th style="text-align:center;">Mã khách hàng</th>
         				<th style="text-align:center;">Phương thức thanh toán<br><span class="js-sorter-desc glyphicon glyphicon-chevron-down" style="font-size:10px;"></span> <span class="js-sorter-asc glyphicon glyphicon-chevron-up" style="font-size:10px;"></span> </th>
          				<th style="text-align:center;">Ngày thanh toán<br><span class="js-sorter-desc glyphicon glyphicon-chevron-down" style="font-size:10px;"></span> <span class="js-sorter-asc glyphicon glyphicon-chevron-up" style="font-size:10px;"></span> </th>
          				<th style="text-align:center;">Ngày giao hàng <span class="js-sorter-desc glyphicon glyphicon-chevron-down" style="font-size:10px;"></span> <span class="js-sorter-asc glyphicon glyphicon-chevron-up" style="font-size:10px;"></span> </th>
          				<th style="text-align:center;">Ngày đặt hàng<br><span class="js-sorter-desc glyphicon glyphicon-chevron-down" style="font-size:10px;"></span> <span class="js-sorter-asc glyphicon glyphicon-chevron-up" style="font-size:10px;"></span> </th>
          				<th style="text-align:center;">Tổng tiền<br><span class="js-sorter-desc glyphicon glyphicon-chevron-down" style="font-size:10px;"></span> <span class="js-sorter-asc glyphicon glyphicon-chevron-up" style="font-size:10px;"></span> </th>
          				<th style="text-align:center;">Tình trạng đơn hàng</th>
          				<th style="text-align:center;">Chức năng</th>
				</thead>
				<tbody class="list" id="fbody" style="text-align:center;">
					<?php
					if(isset($models)){
						foreach ($models as $rows) {
							?>
								<tr>
									<td>VPP<?= $rows->order_id ?></td>
									<td><?= $rows->user_id ?></td>
									<td><?= $rows->payment_method ?></td>
									<td><?= $rows->payment_date ?></td>
									<td><?= $rows->ship_date ?></td>
									<td><?= $rows->order_date ?></td>
									<td><?= number_format($rows->total) ?> vnđ</td>
									<td>
									    <?php if($rows->order_status == 'Đang phê duyệt'){ ?>
									    <span class="btn btn-danger">Đang phê duyệt</span>
									    <?php }elseif($rows->order_status == 'Đang giao hàng'){ ?>
									    <span class="btn btn-warning">Đang giao hàng</span>
									    <?php }else{ ?>
									    <span class="btn btn-success">Đã thanh toán</span>
									    <?php } ?>
									</td>
									<td>
										<?= Html::a("<i class='fa fa-eye'></i>", ['/admin/default/xemchitiet','id'=>$rows->order_id], ['title'=>'Xem chi tiết']) ?>  
										<?= Html::a("<i class='glyphicon glyphicon-pencil'></i>", ['/admin/default/sua','id'=>$rows->order_id], ['title'=>'Sửa']) ?>  
										<a href="<?= Yii::$app->homeUrl ?>admin/default/delete?id=<?= $rows->order_id ?>" onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa hóa đơn này !')" title="Xóa"><i class="fa fa-trash"></i></a> 
									</td>
								</tr>
							<?php
						}
					}
					?>
					
				</tbody>
			</table>
			<div style="text-align:right"><?= LinkPager::widget(['pagination' => $pages]) ?></div>
		</div>
	</div>
</div>
<script src="<?= Yii::$app->homeUrl ?>js/jquery.js"></script>
<script src="<?= Yii::$app->homeUrl ?>js/dynamitable.jquery.min.js"></script>
<script>
	$(document).ready(function(){
		$('#result').hide();
		$("#flash").delay(2000).fadeOut();

		function xacnhanxoa(msg){
		    if(window.confirm(msg)){
		        return true;
		    }    
		    return false;
		}
	})

    $("#searchInput").keyup(function () {
	    var rows = $("#fbody").find("tr").hide();
	    if (this.value.length) {
	        var data = this.value.split(" ");
	        $.each(data, function (i, v) {
	            rows.filter(":contains('" + v + "')").show();
	        });
	    } else rows.show();
	});

</script>