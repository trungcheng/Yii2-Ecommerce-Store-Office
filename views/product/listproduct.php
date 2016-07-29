<?php
use yii\widgets\LinkPager;
$formatter = \Yii::$app->formatter;
?>
<style type="text/css">
    .sale {
        position: absolute;
        top: 0;
        right: 15px;
        width: 40px;
        height: 30px;
        background-color: #ff6c25;
        color: #fff;
        text-align: center;
        line-height: 30px;
    }
</style>

<div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <h2 class="section-title2"><?= $name ?></h2>
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
                                    <div class="sale"><?= '-'.$value['discount'].'%' ?></div>
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
                <div class="phantrang1"><?= LinkPager::widget(['pagination' => $pagination]) ?></div>
                <?php
                	}else{
                		echo "<h2>Danh mục trống !</h2>";
                	}
                ?>
            </div>
        </div>
    </div>


    