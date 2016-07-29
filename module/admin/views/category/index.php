<?php
	use \yii\helpers\Html;
?>
<div class="container page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        	<h1>Quản lý danh mục</h1><br>
			<?php if(Yii::$app->session->hasFlash('success')){ ?>
		        <div class="alert alert-success" id="flash" align="center" role="alert">
		            <?= Yii::$app->session->getFlash('success') ?>
		        </div>
		    <?php } ?>
        	<br>
        	<p><?= Html::a("<i class='glyphicon glyphicon-plus'></i> Thêm mới", ['/admin/category/them'], ['class'=>'btn btn-primary']) ?>
        		<?= Html::a("<i class='glyphicon glyphicon-refresh'></i> Làm mới", ['/admin/category/index'], ['class'=>'btn btn-success']) ?>
        	</p>
			<table class="table table-hover table-bordered" style="margin-top:20px;">
				<thead>
					<th style="text-align:center;">#</th>
					<th style="text-align:center;">Tên danh mục</th>
					<th style="text-align:center;">Mô tả danh mục</th>
					<th style="text-align:center;">Hành động</th>
				</thead>
				<tbody style="text-align:center;">
					<?php
						foreach ($model as $rows) {
							?>
							<tr>
								<td><?= $rows->cat_id ?></td>
								<td><?= $rows->name ?></td>
								<td><?= $rows->description ?></td>
								<td>
									<?= Html::a("<i class='fa fa-eye'></i>", ['/admin/category/xem','id'=>$rows->cat_id], ['title'=>'Xem chi tiết']) ?>
									<?= Html::a("<i class='glyphicon glyphicon-pencil'></i>", ['/admin/category/sua','id'=>$rows->cat_id], ['title'=>'Sửa']) ?>
									<a href="<?= Yii::$app->homeUrl ?>admin/category/delete?id=<?= $rows->cat_id ?>" onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa danh mục này !')" title="Xóa"><i class="fa fa-trash"></i></a>
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
	
	// $("#select_checkbox").click(function(){
 //         if ($(this).is(':checked')) {
 //                $(".checkbox").attr("checked", true);
 //         }else{
 //                $(".checkbox").attr("checked", false);
 //         }
 //    });

 //    $("button#delete_all").click(function(){
 //        var ids = new Array();
 //        $(this).parent('div#checkall').find('[name="ids[]"]:checked').each(function()
 //        {
 //            ids.push($(this).val());
 //            return ids;
 //        });
         
 //        ids = $.unique(ids);
 //        if(confirm("Bạn chắc chắn muốn xóa danh mục này"))
 //        {
 //            console.log(ids);
 //        }
 //    });

	function xacnhanxoa(msg){
	    if(window.confirm(msg)){
	        return true;
	    }    
	    return false;
	}
</script>