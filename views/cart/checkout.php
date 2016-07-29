<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Thanh toán / Xác định thành phần khách hàng';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
  	<div class="panel-heading">
    	<h3 class="panel-title">Bạn là thành viên hay khách hàng mới?</h3>
  	</div>
  	<div class="panel-body">
  		<div class="row">
		    <div class="col-xs-12">
		      	<br> <h4>Bạn là thành viên của chúng tôi hay khách hàng mới ?</h4>
		      	<br>
		      	<form method="post" action="" id="form-checkout">
			      	<div class="radio">
			      		<input type="radio" name="radio" value="Tôi là thành viên của VPP2000">
					  	<label>Tôi là thành viên của VPP2000.</label>
					</div>
					<div class="radio">
						<input type="radio" name="radio" value="Tôi là khách hàng mới">
					  	<label>Tôi là khách hàng mới.</label>
					</div>
			      	<br><br>
			      	<button id="submit" type="submit" class="btn btn-success">Tiếp tục</button>
		      	</form>
		    </div>
		</div>
  	</div>
</div>
