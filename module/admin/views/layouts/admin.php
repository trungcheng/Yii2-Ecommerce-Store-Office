<?php

use yii\helpers\Html;
use app\assets\AppAsset;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BackEnd - VPP2000</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="<?= Yii::$app->homeUrl ?>images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?= Yii::$app->homeUrl ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= Yii::$app->homeUrl ?>css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="<?= Yii::$app->homeUrl; ?>fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= Yii::$app->homeUrl ?>css/ionicons.min.css">
    <link rel="stylesheet" href="<?= Yii::$app->homeUrl ?>css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= Yii::$app->homeUrl ?>css/skin-blue.min.css">
    <link rel="stylesheet" href="<?= Yii::$app->homeUrl ?>css/mycss.css">
    <?= Html::csrfMetaTags() ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <a href="<?= Yii::$app->homeUrl ?>admin" class="logo">
      <span class="logo-mini"><b>V</b>PP</span>
      <span class="logo-lg"><b>VPP</b>2000</span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <div class="logo">
            <img src="<?= Yii::$app->homeUrl ?>images/photo1.jpg" width="32px" height="32px" alt="Đinh Trung" title="Đinh Trung">
        </div>
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs">Đinh Trung</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <div class="logo2">
                    <img src="<?= Yii::$app->homeUrl ?>images/photo1.jpg" width="100px" height="100px" alt="Đinh Trung" title="Đinh Trung">
                </div>
                <p>
                  Mr.Trung
                  <small>Admin tại vpp2000.com</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Thông tin cá nhân</a>
                </div>
                <div class="pull-right">
                  <a href="<?= Yii::$app->homeUrl ?>site/signout" class="btn btn-default btn-flat">Đăng xuất</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar" style="margin-top:20px;">
      <ul class="sidebar-menu">
        <li><a href="<?= Yii::$app->homeUrl ?>admin/category/index"><i class="fa fa-bars"></i> <span>Quản lý danh mục</span></a></li>
        <li><a href="<?= Yii::$app->homeUrl ?>admin/product/index"><i class="fa fa-shopping-bag"></i> <span>Quản lý sản phẩm</span></a></li>
        <li><a href="<?= Yii::$app->homeUrl ?>admin/default/index"><i class="fa fa-shopping-basket"></i> <span>Quản lý đơn hàng</span></a></li>
        <li><a href="<?= Yii::$app->homeUrl ?>admin/user/index"><i class="fa fa-male"></i> <span>Quản lý khách hàng</span></a></li>
        <li><a href="<?= Yii::$app->homeUrl ?>admin/article/index"><i class='tiki-icons glyphicon glyphicon-pencil'></i> <span>Quản lý bài viết</span></a></li>
      </ul>
    </section>
  </aside>
  <div class="content-wrapper">
    <?= $content ?>
  </div>
  <footer class="main-footer">
    <strong>&copy; 2016</strong> Bản quyền thuộc về <strong>vpp2000.hongdt.com</strong>
  </footer>
</div>
<script src="<?= Yii::$app->homeUrl ?>js/jquery.js"></script>
<script src="<?= Yii::$app->homeUrl ?>js/bootstrap.min.js"></script>
<script src="<?= Yii::$app->homeUrl ?>js/app.min.js"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>