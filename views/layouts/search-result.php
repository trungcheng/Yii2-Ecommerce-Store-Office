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
use app\components\CategoryWidget;
use app\components\MainheaderWidget;
use app\components\SlideshowWidget;
use app\components\TopheaderWidget;

AppAsset::register($this);
$formatter = \Yii::$app->formatter;
$session = Yii::$app->session;
$models = $session->get('cart');
$listpro_new = Product::find()->where(['cat_id'=>8,'status'=>0,'deleted'=>0])->orderBy('pro_id DESC')->limit(5)->all();
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

        <title>Search Result</title>
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/bootstrap.min.css" type="text/css" />
        <link href="<?= Yii::$app->homeUrl; ?>css/owl.carousel.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?= Yii::$app->homeUrl; ?>fonts/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/style.css" type="text/css" />
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/mycss.css" type="text/css" />
    </head>
    <body>
        <?= TopheaderWidget::widget(); ?>
        <?= MainheaderWidget::widget(); ?>

        <hr style="border-color:#ccc;">
        
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div style="margin-top:15px;"><?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    </div>
                    <?= $content ?>

                </div>
            </div>
        
        <h2 class="section-title3">Đối tác</h2>
        <div class="brands-area">
            <div class="zigzag-bottom"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="brand-wrapper">
                            <div class="brand-list">
                                <img src="<?= Yii::$app->homeUrl; ?>images/epson.png" alt="Công ty EPSON Việt Nam">
                                <img src="<?= Yii::$app->homeUrl; ?>images/fahasa.jpg" alt="Công ty sách Fahasa Việt Nam">
                                <img src="<?= Yii::$app->homeUrl; ?>images/panasonic.png" alt="Công ty Panasonic Việt Nam">
                                <img src="<?= Yii::$app->homeUrl; ?>images/flex.png" alt="Công ty Flexoffice Việt Nam">
                                <img src="<?= Yii::$app->homeUrl; ?>images/pentel.jpg" alt="Công ty cổ phần Pentel Việt Nam">
                                <img src="<?= Yii::$app->homeUrl; ?>images/kingston.png" alt="Công ty Kingston Việt Nam">
                                <img src="<?= Yii::$app->homeUrl; ?>images/hp.png" alt="Công ty máy tính Hp Việt Nam">
                                <img src="<?= Yii::$app->homeUrl; ?>images/nutifood.jpg" alt="Công ty thực phẩm NutiFood Việt Nam">                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End brands area -->
        </div>
        <div style="clear:both;"></div>
        <div class="footer-top-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Hỗ trợ khách hàng</h2>
                        <ul>
                            <li><a href="">Các câu hỏi thường gặp</a></li>
                            <li><a href="">Gửi yêu cầu hỗ trợ</a></li>
                            <li><a href="">Hướng dẫn đặt hàng</a></li>
                            <li><a href="">Phương thức vận chuyển</a></li>
                            <li><a href="">Chính sách đổi trả</a></li>
                        </ul>                        
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Liên hệ </h2>
                        <ul>
                            <li><a href="">CS1: Linh Đàm - Hoàng Mai - Hà Nội</a></li>
                            <li><a href="">CS2: Mỹ Đình - Từ Liêm - Hà Nội</a></li>
                            <li><a href="">Hotline: 0966. 688. 441 & 0986.390.265</a></li>
                            <li><a href="">Email: vanphongpham2000@gmail.com</a></li>
                            <li><a href="">Facebook: Vpp2000</a></li>
                        </ul>                        
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Danh mục</h2>
                        <ul>
                            <li><a href="">Giấy - Bìa</a></li>
                            <li><a href="">Bút viết các loại</a></li>
                            <li><a href="">File hồ sơ các loại</a></li>
                            <li><a href="">Sổ các loại</a></li>
                            <li><a href="">Băng dính các loại</a></li>
                        </ul>                        
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Về chúng tôi</h2>
                        <ul>
                            <li><a href="">Giới thiệu</a></li>
                            <li><a href="">Tuyển dụng</a></li>
                            <li><a href="">Tin tức</a></li>
                            <li><a href="">Dịch vụ văn phòng</a></li>
                            <li><a href="">Đối tác & Khách hàng</a></li>
                        </ul>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="copyright">
                       <p>&copy; 2015 Bản quyền thuộc về vpp2000.hongdt.com </p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="footer-card-icon">
                        <img src="<?= Yii::$app->homeUrl; ?>images/payment.png" />
                    </div>
                </div>
            </div>
        </div>
    </div>
        
        <script src="<?= Yii::$app->homeUrl; ?>js/jquery.js"></script>
        <script src="<?= Yii::$app->homeUrl; ?>js/bootstrap.min.js"></script>
        <script src="<?= Yii::$app->homeUrl; ?>js/owl.carousel.min.js"></script>
        <script src="<?= Yii::$app->homeUrl; ?>js/jquery.sticky.js"></script>
        <script src="<?= Yii::$app->homeUrl; ?>js/jquery.easing.1.3.min.js"></script>
        <script src="<?= Yii::$app->homeUrl; ?>js/main.js"></script>
        <script type="text/javascript" src="<?= Yii::$app->homeUrl; ?>js/bxslider.min.js"></script>
        <script type="text/javascript" src="<?= Yii::$app->homeUrl; ?>js/script.slider.js"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
