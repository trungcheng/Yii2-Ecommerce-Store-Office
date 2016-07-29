<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Category;
use app\models\Product;
use yii\web\Session;
use yii\bootstrap\ActiveForm;
use app\components\CategoryWidget;
use app\components\MainheaderWidget;
use app\components\SlideshowWidget;
use app\components\TopheaderWidget;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keyword" content="văn phòng phẩm,văn phòng phẩm chất lượng tại hà nội,văn phòng phẩm 2000,văn phòng phẩm uy tín,đồ dùng văn phòng phẩm giá tốt,thiết bị văn phòng,dịch vụ văn phòng">
        <meta name="description" content="Văn phòng phẩm 2000 chuyên cung cấp sỉ lẻ,phân phối,kinh doanh các đồ dùng,thiết bị văn phòng phẩm chất lượng nhất,giá hợp lý nhất và dịch vụ chất lượng nhất.">

        <link rel="shortcut icon" href="<?= Yii::$app->homeUrl; ?>images/favicon.ico" type="image/x-icon" />

        <title>Văn phòng phẩm 2000 - BackEnd</title>
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/AdminLTE.min.css">
        <!-- iCheck -->
    </head>
<body class="hold-transition login-page" cz-shortcut-listen="true">


<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Đăng nhập Admin</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">

        <?= $content ?>
        <!-- <form action="" method="post">
            <div class="form-group has-feedback">
                <input type="email" name="email" class="form-control" placeholder="Email" required="">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required="">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-offset-7 col-xs-5">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                </div>
            </div>
        </form> -->

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<!-- jQuery 2.1.4 -->
<script src="<?= Yii::$app->homeUrl; ?>js/jquery.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="<?= Yii::$app->homeUrl; ?>js/bootstrap.min.js"></script>


<script>
    $(".alert").fadeTo(5000, 500).slideUp(500, function () {
        $(".alert").alert('close');
    })
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>