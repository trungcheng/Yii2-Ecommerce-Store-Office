<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<body>
<div class="main-header">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-12 col-sm-12 logo-w">
                <a href="<?= Yii::$app->homeUrl; ?>"><img src="<?= Yii::$app->homeUrl; ?>images/logo1.png" title="Văn phòng phẩm 2000" alt="Văn phòng phẩm 2000" width="185" height="75"></a>
            </div>
            <div class="col-md-7 col-xs-12 col-sm-12 search">
                <div class="input-group">
                      <input name="pro_name" id="pro_name" type="text" class="form-control" placeholder="Tìm sản phẩm, danh mục bạn mong muốn...">
                      <span class="input-group-btn">
                            <button id="search" name="search" class="btn btn-default search-button" type="button">TÌM</button>
                      </span>
                </div>
            </div>
            <div class="col-md-2 user">
                <a href="#" class="fa fa-bars bar-toggle"></a>
                <div class="col-md-6 user-login">
                    <button id="user-dropdown" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="box-user">
                            <i class="fa fa-sign-in dangnhap"></i>
                            <h4><a href="#">Đăng nhập <span class="caret"></span></a></h4>
                            <span>Tài khoản & Đơn hàng</span>
                        </div>
                    </button>
                    <ul class="dropdown-menu user-ajax-guest">
                        <?php if (Yii::$app->user->isGuest) { ?>
                        <li id="login_link">
                            <a href="<?= Yii::$app->homeUrl ?>site/signin" data-toggle="modal" title="Đăng Nhập">
                                <i class="fa fa-sign-in"></i>
                                <span>Đăng nhập</span>
                            </a>
                        </li>
                        <li class="user-name-register">
                            <a href="<?= Yii::$app->homeUrl ?>site/signup" title="Tạo tài khoản mới" data-toggle="modal">
                                <i class="fa fa-user"></i>
                                <span>Đăng ký</span>
                            </a>
                        </li>
                        <?php }else{ ?>
                        <li class="user-name-register">
                            <a href="<?= Yii::$app->homeUrl ?>site/signout" title="Tạo tài khoản mới" data-toggle="modal">
                                <i class="fa fa-user"></i>
                                Đăng xuất (<span style="color:red;"><?= Yii::$app->user->identity->email ?></span>)
                            </a>
                        </li>
                        <?php } ?>
                        <li class="user-name-register">
                            <a href="#" title="Check đơn hàng" data-toggle="modal" data-target="#checkModal">
                                <i class="fa fa-check"></i>
                                <span>Check đơn hàng</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 col-xs-12 col-sm-12 user-cart">
                    <a href="<?= Yii::$app->homeUrl ?>cart/index" class="user-cart-link">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="cart-quantity">
                            <?php
                                if(isset($_SESSION['cart'])){
                                    echo count($_SESSION['cart']);
                                }
                                else{
                                    echo "0";
                                }
                            ?>
                        </span> 
                    </a>
                </div>
            </div>
        </div>
    </div> <!-- end container -->
</div> <!-- end main-header -->
</body>

<script src="<?= Yii::$app->homeUrl ?>js/jquery.js"></script>
<script>
  $(document).ready(function(){
    $("#pro_name").keypress(function (event) {
        if (event.which == 13) {
                var pro_name = $('#pro_name').val();
                var url = '<?= Yii::$app->homeUrl. 'site/search' ?>';

                $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        pro_name: pro_name
                    },
                    success: function(data){
                        window.location.href = url;
                    }
                });
        }else{
            $('button#search').click(function() {
                var pro_name = $('#pro_name').val();
                var url = '<?= Yii::$app->homeUrl. 'site/search' ?>';

                $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        pro_name: pro_name
                    },
                    success: function(data){
                        window.location.href = url;
                    }
                });
            });
        }
    });
  });
</script>



