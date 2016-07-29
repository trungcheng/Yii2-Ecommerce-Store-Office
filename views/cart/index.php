<?php
use yii\helpers\Html;

$num = 1;
$total = 0;
?>
<div class="shopping-cart">
<h2 align="left" style="padding-bottom:5px;font-size:26px;font-weight:600;font-family:Arial;position:relative;">Giỏ hàng của bạn</h2>
<?php if(Yii::$app->session->hasFlash('error')){ ?>
    <div class="alert alert-danger" id="flash" align="center" role="alert">
        <?= Yii::$app->session->getFlash('error') ?>
    </div>
<?php } ?>
<?php if(Yii::$app->session->hasFlash('success')){ ?>
    <div class="alert alert-success" id="flash" align="center" role="alert">
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php } ?><br>
  <form action="update" method="get">
    <table class="table">
    <thead>
        <tr>
           <th style="text-align:center">#</th>
           <th style="text-align:center">Hình ảnh</th>
           <th style="text-align:center">Tên sản phẩm</th>
           <th style="text-align:center">Giá</th>
           <th style="text-align:center">Giảm giá (%)</th>
           <th style="text-align:center">Số lượng</th>
           <th style="text-align:center">Thành tiền</th>
           <th style="text-align:center">Xóa</th>
        </tr>
    </thead>
    <tbody>
      <?php
      	if(count($models)>0){
      		foreach ($models as $value) {
      			?>
  				<tr>
		         	<td align="center" scope="row"><?= $num++ ?></td>
		         	<td align="center"><img src="<?= Yii::$app->homeUrl ?><?= $value["image"] ?>" width="50px" height="50px" /></td>
			        <td align="center"><?= $value["name"] ?></td>
			        <td align="center"><?= number_format($value["price"]) ?> vnd</td>
              <td align="center"><?= $value['discount'] ?></td>
			        <td align="center">
                  <?= Html::a('-', ['cart/giam', 'id' => $value['pro_id']], ['class' => 'btn btn-danger'])?>
                  <input id="qty" type="number" min="20" max="1000" name="soluong[]" value="<?= $value["qty"] ?>" />
                  <?= Html::a('+', ['cart/tang', 'id' => $value['pro_id']], ['class' => 'btn btn-success'])?>
              </td>
                    <input type="hidden" name="id[]" value="<?= $value["pro_id"] ?>" />
              <td align="center"><?= number_format((($value['price'])-($value['price']*$value['discount'])/100)*$value["qty"]); ?> VNĐ</td>
                 <td align="center">
                     <?= Html::a('<i class="glyphicon glyphicon-remove"></i>', ['cart/remove', 'id' => $value['pro_id']], ['class' => 'btn btn-danger']) ?>
                 </td>
		      </tr>
          <?php
          $total += ((($value['price'])-($value['price']*$value['discount'])/100)*$value["qty"]);
      		}
      	}else{ ?>
        	<tr><span style="color:red;">Bạn chưa có sản phẩm nào trong giỏ hàng !</span></tr>
        <?php    
        }
      	?>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td style="text-align:center">Tổng tiền: </td>
              <td style="text-align:center"><span style="color:red;font-weight:bold;"><?= number_format($total) ?></span> vnd</td>
              
          </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td>
                  <input id="submit" type="submit" class="btn btn-primary" value="Cập nhật" name="btnupdate" />
              </td>
               <td style="text-align:center">
                  <?= Html::a('Mua tiếp', ['site/index'], ['class' => 'btn btn-warning']) ?>
               </td>
               <td style="text-align:center">
                  <?= Html::a('Đặt hàng', ['cart/checkout'], ['class' => 'btn btn-success']) ?>
                </td>
                <td style="text-align:center">
                  <?= Html::a('Xóa giỏ hàng', ['cart/removeall'], ['class' => 'btn btn-danger']) ?>
               </td>
            </tr>
   </tbody>
</table>
</form>
</div>

<div class="modal fade" id="checkModal" tabindex="-1" role="dialog" aria-labelledby="checkModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Kiểm tra đơn hàng</h4>
      </div>
      <div class="modal-body">
        <?php
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

<script src="<?= Yii::$app->homeUrl ?>js/jquery.js"></script>
<script>
  $(document).ready(function(){
    $("#flash").delay(3000).fadeOut();
  });
</script>
