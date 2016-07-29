<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Order;

$this->title = 'Thanh toán / Xác nhận thanh toán';
$this->params['breadcrumbs'][] = $this->title;
$stt = 1;
?>
<div class="panel panel-default">
  	<div class="panel-heading">
    	<h3 class="panel-title">3. Xác nhận thanh toán:</h3>
  	</div>
  	<div class="panel-body">
  		<div class="col-md-3 checkout-success-icon">
  			<i class="fa fa-check"></i>
  		</div>
  		<div class="col-md-9">
  			<h4>Cảm ơn bạn đã mua hàng tại VPP2000 !</h4>
  			<p>Mã số đơn hàng của bạn là:</p>
  			<div class="no-order"><p>VPP<?= $order_id ?></p></div>
  			<p>Sau đây là thông tin chi tiết về đơn hàng của bạn:</p>
  			<table class="table table-hover table-bordered" style="margin-top:15px;">
            <tr>
                <th>#</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Giảm giá (%)</th>
                <th>Thành tiền</th>
            </tr>
            <?php
                foreach ($data as $value) { ?>
                    <tr>
                        <td><?= $stt++ ?></td>
                        <td><?= $value->name ?></td>
                        <td><?= $value->price ?></td>
                        <td><?= $value->qty ?></td>
                        <td><?= $value->discount ?></td>
                        <td><?= number_format((($value['price'])-($value['price']*$value['discount'])/100)*$value["qty"]); ?> <u>đ</u></td>
                    </tr>
            <?php        
                }
            ?>
            <tr>
                <td></td><td></td><td></td><td></td><td>Tổng tiền: </td><td><strong><?php
                    $total = 0;
                    foreach($data as $value){
                      $total += ((($value['price'])-($value['price']*$value['discount'])/100)*$value["qty"]);
                    }
                    echo number_format($total);
                ?> <u>đ</u></strong></td>
            </tr>
        </table>
  			<p>Thời gian dự kiến giao hàng vào: 
          <strong><?= $ship_date ?></strong>
        </p>
  			<p>Thông tin chi tiết về đơn hàng sẽ được gửi đến địa chỉ email <strong style="color:red;"><?= $email ?></strong>. Nếu không tìm thấy vui lòng kiểm tra trong hộp thư <strong>Spam</strong> hoặc <strong>Junk Folder</strong>.</p>
  			<div class="panel panel-default note-checkout">
  				<div class="panel-heading">
  					<img src="<?= Yii::$app->homeUrl ?>images/ico13.png">
  					<p>Nhằm giúp việc xử lý đơn hàng nhanh hơn nữa, <strong>VPP2000</strong> sẽ không gọi điện cho bạn để xác nhận đơn hàng.</p>
  				</div>
  			</div>
  		</div>
	</div>
</div>  		