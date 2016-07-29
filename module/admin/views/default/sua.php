<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="<?= Yii::$app->homeUrl ?>css/bootstrap-datetimepicker.min.css">
</head>
<body>
<div class="container page-wrapper">
    <div class="row">
        <form action="" method="post" role="form">
        <div class="col-lg-4">
            <h1>Cập nhật hóa đơn</h1><br>
                    <div class="form-group">
                        <label for="user_id">Mã khách hàng</label>
                        <input class="form-control" type="text" name="user_id" id="user_id" value="<?= $model->user_id ?>">
                    </div>
                    <div class="form-group">
                        <label for="payment_method">Phương thức thanh toán</label>
                        <select class="form-control" name="payment_method" >
                          <option disable hidden>-- Hãy chọn 1 trong 3 hình thức thanh toán --</option>
                          <option selected>Thanh toán tiền mặt khi nhận hàng</option>
                          <option>Thanh toán trực tuyến bằng ví điện tử Ngân Lượng</option>
                          <option>Thanh toán bằng thẻ Visa, Master...</option>
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="payment_info">Thông tin thanh toán</label>
                        <textarea class="form-control" type="text" name="payment_info" id="payment_info" value="<?= $model->payment_info ?>"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="message">Ghi chú</label>
                        <textarea class="form-control" type="text" name="message" id="message" value="<?= $model->message ?>"></textarea>
                    </div><br>
                    <input type="submit" class="btn btn-primary" value="Cập nhật">
        </div>
        <div class="col-lg-4">
            <h1 style="opacity:0;">.</h1><br>
                    <div class="form-group">
                        <label for="total">Tổng tiền</label>
                        <input class="form-control" type="text" name="total" id="total" value="<?= $model->total ?>">
                    </div>
                    <div class="form-group">
                        <label for="order_status">Tình trạng</label>
                        <select class="form-control" name="order_status">
                          <option disable hidden>-- Trạng thái đơn hàng --</option>
                          <option selected>Đang phê duyệt</option>
                          <option>Đang giao hàng</option>
                          <option>Đã thanh toán</option>
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="order_date">Ngày đặt hàng</label>
                        <div class="input-group date form_datetime" id="order_date">
                            <input class="form-control" type="text" name="order_date" id="order_date" value="<?= $model->order_date ?>">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="payment_date">Ngày giao hàng</label>
                        <div class="input-group date form_date" id="ship_date">
                            <input class="form-control" type="text" name="ship_date" id="ship_date" value="<?= $model->ship_date ?>">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="payment_date">Ngày thanh toán</label>
                        <div class="input-group date form_datetime" id="payment_date">
                            <input class="form-control" type="text" name="payment_date" id="payment_date" value="<?= $model->payment_date ?>">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                        </div>
                    </div>
        </div>
        </form>
    </div>
</div>
</body>

<script src="<?= Yii::$app->homeUrl ?>js/jquery.js"></script>
<script src="<?= Yii::$app->homeUrl ?>js/bootstrap.min.js"></script>
<script src="<?= Yii::$app->homeUrl ?>js/bootstrap-datetimepicker.js"></script>
<script src="<?= Yii::$app->homeUrl ?>js/bootstrap-datetimepicker.ru.js"></script>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        isRTL: true,
        inline: false,
        format: 'dd-mm-yyyy hh:ii:ss',
        autoclose:true,
        language: 'vi',
        todayHighlight: 1
    });
    $('.form_date').datetimepicker({
        isRTL: true,
        inline: false,
        format: 'dd-mm-yyyy',
        autoclose:true,
        language: 'vi',
        todayHighlight: 1
    });
</script>
</body>
</html>
