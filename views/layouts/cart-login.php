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

        <title>Thành viên đăng nhập</title>
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
        <a href="#"><h2>Đăng nhập thành viên</h2></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">

        <?= $content ?>
        <a href="<?= Yii::$app->homeUrl ?>site/forgotpw" class="text-center">Quên mật khẩu ?</a>
        <a href="<?= Yii::$app->homeUrl ?>site/signup" class="pull-right">Đăng ký</a>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<!-- jQuery 2.1.4 -->
<script src="<?= Yii::$app->homeUrl; ?>js/jquery.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="<?= Yii::$app->homeUrl; ?>js/bootstrap.min.js"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>