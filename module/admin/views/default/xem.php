<?php
	use \yii\helpers\Html;
	use yii\widgets\LinkPager;
?>
<div class="container page-wrapper">
    <div class="row">
        <div class="col-lg-12">
        	<h1>Hóa đơn chi tiết <span style="color:red;">#<?= $oid ?></span></h1><br>
        	<?= Html::a("<i class='glyphicon glyphicon-arrow-left'></i> Quay lại", ['/admin/order/index'], ['class'=>'btn btn-info']) ?>
        	<?= Html::a("<i class='glyphicon glyphicon-plus'></i> Thêm mới", ['/admin/order/themchitiet'], ['class'=>'btn btn-primary']) ?>
			<table class="table table-hover table-bordered" style="margin-top:20px;">
				<thead>
					<th style="text-align:center;">#</th>
					<th style="text-align:center;">Thuộc hóa đơn</th>
					<th style="text-align:center;">Mã sản phẩm</th>
					<th style="text-align:center;">Tên</th>
					<th style="text-align:center;">Giá</th>
					<th style="text-align:center;">Số lượng</th>
					<th style="text-align:center;">Hành động</th>
				</thead>
				<tbody style="text-align:center;">
					<?php

						foreach ($models as $rows) {
							?>
							<tr>
								<td><?= $rows->order_detail_id ?></td>
								<td><?= $rows->order_id ?></td>
								<td><?= $rows->pro_id ?></td>
								<td><?= $rows->name ?></td>
								<td><?= number_format($rows->price_newest) ?> vnđ</td>
								<td><?= $rows->quantity ?></td>
								<td>
									<?= Html::a("<i class='glyphicon glyphicon-pencil'></i>", ['/admin/order/suachitiet','id'=>$rows->order_detail_id]) ?>
									<?= Html::a("<i class='fa fa-trash'></i>", ['/admin/order/xoachitiet','id'=>$rows->order_detail_id]) ?>
								</td>
							</tr>
							<?php
						}
					?>
				</tbody>
			</table>
			<div style="text-align:right;padding-right:55px"><?= LinkPager::widget(['pagination' => $pages]) ?></div>
		</div>
	</div>
</div>