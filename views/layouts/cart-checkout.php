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

        <title><?php echo Html::encode($this->title); ?></title>
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/bootstrap.min.css" type="text/css" />
        <link href="<?= Yii::$app->homeUrl; ?>css/owl.carousel.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?= Yii::$app->homeUrl; ?>fonts/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/style.css" type="text/css" />
        <?= Html::csrfMetaTags() ?>
    </head>
    <body>
        
        <?= TopheaderWidget::widget(); ?>
        <?= MainheaderWidget::widget(); ?>
        <?php 
            $listpro_sale = Product::find()->where('discount > 0',['status'=>0,'deleted'=>0])->all();
        ?>
        
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div style="margin-top:15px;"><?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    </div>
                    <div style="margin-bottom:60px;">
                        <?= $content ?>
                    </div>
                </div>
                <div class="col-md-3 sidebar">
                    <div class="cart">
                        <div class="title-sidebar">
                            <p>Thông tin giỏ hàng</p>
                        </div>
                        <div class="box-giohang">
                            <p>
                                Đang có <a href="cart"> <?php
                                                    if(isset($_SESSION['cart'])){?>
                                                      <span style="color:red;"><?= count($_SESSION['cart']); ?></span>
                                                      <?php
                                                    }
                                                    else{?>
                                                      <span style="color:red;"><?= 0 ?></span>
                                                      <?php
                                                    }
                                                  ?> </a>sản phẩm trong giỏ</p>
                                <p>Tổng tiền: <?php
                                                  if(isset($_SESSION['cart'])){
                                                      $total = 0;
                                                      foreach($models as $value){
                                                        $total += ((($value['price'])-($value['price']*$value['discount'])/100)*$value["qty"]);
                                                      }
                                                      ?>
                                                      
                                                      <span style="color:red;"><?= number_format($total) ?></span>
                                                      <?php
                                                  }else{
                                                    ?>
                                                    <span style="color:red;"><?= 0 ?></span>
                                                    <?php
                                                  }
                                              ?> vnđ
                                </p>
                            <span style="color:blue;"><a href="<?= Yii::$app->homeUrl ?>cart/index">Xem giỏ hàng >></a></span>
                        </div>
                    </div>
                    <div class="cart">
                        <div class="title-sidebar">
                            <p>Sản phẩm mới nhất</p>
                        </div>
                        <div class="box-giohang">
                            <?php foreach($listpro_new as $value){ ?>
                                <tr>
                                    <div class="box-spmn">
                                        <a href="<?= Yii::$app->homeUrl."product/detail/".$value->pro_id ?>" class="thumnail">
                                            <img src="<?= Yii::$app->homeUrl."$value->image" ?>" width="80px" height="70px" class="pull-left">
                                        </a>
                                        <p>
                                            <a href="<?= Yii::$app->homeUrl."product/detail/".$value->pro_id ?>" class="tensp"><?= $value->name ?></a><br>
                                            <?php
                                            if(($value->discount) == 0) { ?>
                                                <ins><?= number_format($value->price); ?> VNĐ</ins>  
                                            <?php }else{ ?>
                                                <ins><?= number_format(($value->price)-(($value->price)*($value->discount))/100); ?> VNĐ</ins>
                                                <del><?= number_format($value->price); ?> VNĐ</del>
                                            <?php
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </tr>                            
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="clear:both;"></div><br><br>
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
