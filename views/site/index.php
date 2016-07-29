<?php
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="latest-product">
                    <h2 class="section-title">Ưu đãi mới !</h2>
                    <div class="product-carousel">
                    <?php
                        foreach($listpro_sale as $value){
                    ?>
                        <div class="single-product">
                            <div class="product-f-image">
                                <img src="<?= Yii::$app->homeUrl.$value['image'] ?>" alt="">
                                <div class="product-hover">
                                    <a href="<?= Yii::$app->homeUrl ?>cart/add/<?= $value['pro_id'] ?>" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Mua ngay</a>
                                    <a href="<?= Yii::$app->homeUrl."product/detail/".$value['pro_id'] ?>" class="view-details-link"><i class="fa fa-link"></i> Xem ngay</a>
                                </div>
                            </div>
                            
                            <h2><a href="<?= Yii::$app->homeUrl."product/detail/".$value['pro_id'] ?>"><?= $value['name']; ?></a></h2>
                            <div class="product-carousel-price">
                                <ins><?= number_format(($value['price'])-($value['price']*$value['discount'])/100); ?> VNĐ</ins>
                                <del><?= number_format($value['price']); ?> VNĐ</del>
                                <div class="sale"><?= '-'.$value['discount'].'%' ?></div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <h2 class="section-title2">Tất cả sản phẩm</h2>
                <?php
                    if(count($list) > 0){
                        foreach($list as $value){
                ?>
                    <div class="col-md-3 wrapper-product">
                        <div class="single-shop-product">
                            <div class="product-upper">
                                <a href="<?= Yii::$app->homeUrl."product/detail/".$value['pro_id'] ?>" class="thumnail">
                                    <img src="<?= Yii::$app->homeUrl.$value['image'] ?>" />
                                </a>
                            </div>
                            <h2><a href="<?= Yii::$app->homeUrl."product/detail/".$value['pro_id'] ?>"><?= $value['name']; ?></a></h2>
                            <div class="product-carousel-price">
                                <?php if($value['discount']==0){
                                ?>
                                    <ins><?= number_format($value['price']); ?> VNĐ</ins>
                                <?php }
                                else{ ?>
                                    <ins><?= number_format(($value['price'])-($value['price']*$value['discount'])/100); ?> VNĐ</ins>
                                    <del><?= number_format($value['price']); ?> VNĐ</del>
                                    <div class="sale1"><?= '-'.$value['discount'].'%' ?></div>
                                <?php } ?>
                            </div>  
                            <div class="product-option-shop">
                                <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="<?= Yii::$app->homeUrl ?>cart/add/<?= $value['pro_id'] ?>">Mua ngay</a>
                            </div>                       
                        </div>
                    </div>
                <?php
                        }
                ?>
                <div style="clear:both;"></div>   
                <div class="phantrang"><?= LinkPager::widget(['pagination' => $pagination]) ?></div>
                <?php
                    }else{
                        echo "<h2>Danh mục trống !</h2>";
                    }
                ?>
            </div>
        </div>
    </div>
    </div>
</div> <!-- End main content area -->

<div class="modal fade" id="checkModal" tabindex="-1" role="dialog" aria-labelledby="checkModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Kiểm tra đơn hàng</h4>
      </div>
      <div class="modal-body">
        <?php
        if (!\Yii::$app->user->isGuest){
            if(count($order)>0){
                $num = 1;
                echo "<h5>Đơn hàng mới nhất của bạn :</h5><br>";?>

                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                    </tr>
                    <?php
                        foreach ($order_detail as $value) {
                    ?>
                        <tr>
                            <td><?= $num++ ?></td>
                            <td><?= $value->name ?></td>
                            <td><?= $value->price_newest ?></td>
                            <td><?= $value->quantity ?></td>
                        </tr>
                    <?php
                        }
                    ?>
                        <tr>
                            <td></td><td>Tổng tiền: </td>
                            <td><b><?= number_format($order->total) ?> vnđ</b></td>
                            <td></td>
                        </tr>
                </table>
                <br>
                <h5>Trạng thái đơn hàng: <span style="color:red;font-weight:bold;"><?= $order->order_status ?></span></h5>

        <?php        
            }else{
                echo "Xin lỗi, bạn chưa có đơn hàng nào !";
            }
        }else{
            echo "<h5>Xin lỗi, để check được đơn hàng, quý khách cần đăng nhập vào hệ thống của VPP2000 !<br><br>
                Nếu chưa có tài khoản thì cần đăng ký thành viên ngay với địa chỉ email quý khách đã sử dụng để mua hàng ! 
                Cảm ơn quý khách !</h5>";
        }
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
        <a href="<?= Yii::$app->homeUrl ?>" class="btn btn-primary">Mua tiếp</a>
      </div>
    </div>
  </div>
</div>