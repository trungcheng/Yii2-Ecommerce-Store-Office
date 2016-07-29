<?php
use app\models\Product;
use yii\widgets\LinkPager;
use yii\data\Pagination;

$pro_name = $_GET['pro_name'];
$listPro = Product::find()->where(['like', 'name', $pro_name,'deleted'=>0]);
$listPro1 = Product::find()->where(['like', 'name', $pro_name,'deleted'=>0])->all();
$pagination = new Pagination([
    'defaultPageSize' => 8,
    'totalCount' => $listPro->count()
]);

$model = $listPro->orderBy('cat_id')
    ->offset($pagination->offset)
    ->limit($pagination->limit)
    ->all();
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
<h4>Kết quả tìm kiếm với từ khóa: '<span style="color:red;font-weight:600"><?= $pro_name ?></span>' - tìm thấy <span style="color:red;font-weight:600"><?= count($listPro1) ?></span> kết quả</h4>
<br>
<br>
<div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
<?php
                	if(count($model) > 0){
                		foreach($model as $value){
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
                    }
                ?>
                <div style="clear:both;"></div>   
                <div class="phantrang1"><?= LinkPager::widget(['pagination' => $pagination]) ?></div>
            </div>
        </div>
    </div>
