<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Thanh toán / Phương thức thanh toán & Đặt mua';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
  	<div class="panel-heading">
    	<h3 class="panel-title">2. Phương thức thanh toán & Đặt mua:</h3>
  	</div>
  	<div class="panel-body">
  		<div class="row">
		    <div class="col-xs-12">
		      	<br> <h4>Khách hàng vui lòng chọn 1 trong 3 hình thức thanh toán sau:</h4><br>
		      	<form method="post" action="">
			      	<div class="radio">
			      		<input id="id_radio1" type="radio" name="radio" value="Thanh toán tiền mặt khi nhận hàng">
					  	<label>Thanh toán tiền mặt khi nhận hàng</label>
					</div>
					<div class="div1">
						<p>(<span style="color:red;">*</span>) <span style="color:red;">Sau khi quý khách đặt hàng thành công, chúng tôi sẽ gọi điện xác nhận đơn hàng</span></p>
						<p>(<span style="color:red;">*</span>) <span style="color:red;">Quý khách chỉ cần chờ hàng đến và thanh toán tiền.</span></p>
					</div>
					<div class="radio">
						<input id="id_radio2" type="radio" name="radio" value="Thanh toán trực tuyến qua ví điện tử Ngân Lượng">
					  	<label>Thanh toán trực tuyến qua ví điện tử Ngân Lượng</label>
					</div>
					<div class="div1">
						<p>(<span style="color:red;">*</span>) <span style="color:red;">Sau khi quý khách đặt hàng thành công, chúng tôi sẽ gọi điện xác nhận đơn hàng</span></p>
						<a target="_blank" href="https://www.nganluong.vn/button_payment.php?receiver=huydth65@gmail.com&product_name=VPP<?= $oid ?>&price=<?= $total ?>&return_url=http://www.vpp2000.hongdt.com/cart/checkout3customer&comments=Đang cần gấp"><img src="https://www.nganluong.vn/css/newhome/img/button/safe-pay-1.png" border="0" /></a>
					</div>
					<div class="radio">
						<input id="id_radio3" type="radio" name="radio" value="Thanh toán trực tuyến qua thẻ Visa, MasterCard">
					  	<label>Thanh toán trực tuyến qua Ngân hàng</label>
					</div>
					<div class="div1">
						<p>(<span style="color:red;">*</span>) <span style="color:red;">Sau khi quý khách đặt hàng thành công, chúng tôi sẽ gọi điện xác nhận đơn hàng</span></p>
						<img src="<?= Yii::$app->homeUrl ?>images/bank.png" width="100%">
					</div>
			      	<br><br>
			      	<button id="submit" type="submit" class="btn btn-success">Thanh toán</button>
		      	</form>
		    </div>
		</div>
  	</div>
</div>
<script src="<?= Yii::$app->homeUrl ?>js/jquery.js"></script>
<script>
	$(document).ready(function () {
		$('.div1').eq(0).hide();
		$('.div1').eq(1).hide();
		$('.div1').eq(2).hide();

	    $('#id_radio1').click(function () {
	        $('.div1').eq(0).show('fast');
	        $('.div1').eq(1).hide('fast');
	        $('.div1').eq(2).hide('fast');
	    });
	    $('#id_radio2').click(function () {
	        $('.div1').eq(0).hide('fast');
	        $('.div1').eq(1).show('fast');
	        $('.div1').eq(2).hide('fast');
	    });
	    $('#id_radio3').click(function () {
	        $('.div1').eq(0).hide('fast');
	        $('.div1').eq(1).hide('fast');
	        $('.div1').eq(2).show('fast');
	    });
	});
</script>

