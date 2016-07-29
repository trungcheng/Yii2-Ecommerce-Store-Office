<?php

/* @var $this yii\web\View */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use kartik\social\FacebookPlugin;

$this->title = $cat_name .' '.' / '.' '. $detailPro->name;
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="col-md-6" id="box">
      <p style="text-align:center"><a href="#"><img src="<?= Yii::$app->homeUrl.$detailPro->image ?>" class="image" width="300" height="300" /></a></p>
    </div>
    <div class="col-md-6" id="info">
      <p style="text-align:left"><h3 style="color:#000;"><?= $detailPro->name; ?></h3></p>
      <p><span class="giaban">Giá bán :</span> <span class="gia">
      	<?php 
      		if(($detailPro->discount) == 0 ) {
      			echo number_format($detailPro->price);
      		}else{
      			echo number_format(($detailPro->price)-(($detailPro->price)*($detailPro->discount))/100);
      		} 
      	?>
      </span>VNĐ (Chưa có VAT)</p>
      <p><span>Bảo hành : </span>12 tháng</p>
      <p><span>Xuất xứ : </span>Chính hãng</p>
      <p><span>Vận chuyển : </span>Miễn phí nội thành</p>
      <p><span>Trạng thái : </span><span style="color:red;">
          <?php
            if($detailPro->status == 0){
              echo "Còn hàng";
            }else{
              echo "Hết hàng";
            }
          ?>
      </span></p>
      <p>Có ưu đãi và chỉ giao hàng với hóa đơn có số lượng từ <span style="color:red;">20 đơn vị</span> trở lên ! Áp dụng với tất cả các mặt hàng</p><br>


      <p style="text-align:left;width:200px;height:200px;margin-top:15px;"><a class="btn btn-success" href="<?= Yii::$app->homeUrl ?>cart/add/<?= $detailPro->pro_id ?>" role="button">Mua ngay &raquo;</a></p>
    </div><br><br>
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">Mô tả sản phẩm</a></li>
      <li><a href="#comment" data-toggle="tab">Đánh giá sản phẩm</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane fade in active" id="home">
          <h3>Thông tin chi tiết</h3>
          <p><?= $detailPro->description ?></p>
      </div>
      <div class="tab-pane fade" id="comment">
          <?= FacebookPlugin::widget(['type'=>FacebookPlugin::COMMENT,'settings'=>['data-mobile'=>true,'data-width'=>835,'data-numposts'=>5]]) ?>          
      </div>
    </div><br>
    <p style="color:blue">Chúc quý khách chọn mua được sản phẩm như ý !</p>
    <hr>

    <div class="row lienquan">
        <div class="col-md-12">
            <h2 class="section-title">Sản phẩm liên quan</h2>
            <div class="slide-pager">
                <div class="slide-control-prev"><</div>
                <div class="slide-control-next">></div>
            </div>
            <div class="slide-holder">
                <div class="slide-container">
                    <div class="slide-stage">
                        <?php
                            foreach ($proAll as $value) {
                        ?>
                            <div class="slide-image">
                                <a href="<?= Yii::$app->homeUrl."product/detail/".$value->pro_id ?>"><img src="<?= Yii::$app->homeUrl.$value->image ?>"></a>
                                <h5><a href="<?= Yii::$app->homeUrl."product/detail/".$value->pro_id ?>"><?= $value->name; ?></a></h5>
                                <?php if($value->discount == 0){
                                ?>
                                    <ins class="price-main"><?= number_format($value->price); ?> VNĐ</ins>
                                <?php }
                                else{ ?>
                                    <ins class="price-main"><?= number_format(($value->price)-($value->price*$value->discount)/100); ?> VNĐ</ins>
                                    <del><?= number_format($value->price); ?> VNĐ</del>
                                <?php } ?>
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
