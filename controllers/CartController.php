<?php

namespace app\controllers;

use Yii;
use yii\db\ActiveRecord;
use yii\web\Controller;
use app\models\Product;
use app\models\LoginForm;
use app\models\Signup;
use app\models\User;
use app\models\Order;
use app\models\Order_Detail;

class CartController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $this->layout = 'shopping-cart';
        $session = Yii::$app->session;
        $models = $session->get('cart');

        if (!\Yii::$app->user->isGuest) {
            $email = Yii::$app->user->identity->email;
            $user = User::find()->where(['deleted'=>0,'email'=>$email])->one();
            $user_id = $user->user_id;
            $order = Order::find()->where(['deleted'=>0,'user_id'=>$user_id])->orderBy('order_id DESC')->limit(1)->one();
            $order_id = $order->order_id;
            $order_detail = Order_Detail::find()->where(['deleted'=>0,'order_id'=>$order_id])->all();
        }else{
            $order = [];
            $order_detail = [];
        }

        return $this->render('index',['order'=>$order,'order_detail'=>$order_detail,'models'=>$models]);
    }

    public function actionRemoveall(){
        $session = Yii::$app->session;
        $session->get('cart');
        if(!empty($session)){
            $session->removeAll();
            $this->redirect(['cart/index']);
        }
    }

    public function actionRemove(){
        $session = Yii::$app->session;
        $session->get('cart');
        $request = Yii::$app->request;
        $id = $request->get('id');
        unset($_SESSION['cart'][$id]);
        \Yii::$app->getSession()->setFlash('success', 'Xóa sản phẩm thành công !');
        $this->redirect(['cart/index']);
    }

    public function actionGiam(){
        $session = Yii::$app->session;
        $data = $session->get('cart');
        $request = Yii::$app->request;
        $id = $request->get('id');
        if($data[$id]['qty'] > 20){
            $data[$id]['qty'] = $data[$id]['qty'] - 1;
            \Yii::$app->getSession()->setFlash('success', 'Giảm số lượng thành công !');
            $this->redirect(['cart/index']);
        }
        else{
            \Yii::$app->getSession()->setFlash('error', 'Chúng tôi chỉ ship đơn hàng với số lượng mỗi sản phẩm từ 20 trở lên !');
            $this->redirect(['cart/index']);
        }
    }

    public function actionTang(){
        $session = Yii::$app->session;
        $data = $session->get('cart');
        $request = Yii::$app->request;
        $id = $request->get('id');
        if($data[$id]['qty'] >= 20){
            $data[$id]['qty'] = $data[$id]['qty'] + 1;
            \Yii::$app->getSession()->setFlash('success', 'Tăng số lượng thành công !');
            $this->redirect(['cart/index']);
        }
    }

    public function actionAdd(){

        $session = Yii::$app->session;

        if(!$session->isActive){
            $session->open();
        }
        if(!$session->has("cart")){
            $session->set("cart", []);
        }

        $request = Yii::$app->request;
        $id = $request->get('id');
        $pro_name = Product::findOne($id);
        $name = $pro_name->name;
        $product = Product::find()->where(['status'=>0,'deleted'=>0])->all();
        $newProduct = array();
        foreach ($product as $val){
            $newProduct[$val['pro_id']] = $val;
        } 

        if(!isset($_SESSION['cart']) || $_SESSION['cart'] == null){
            $newProduct[$id]['qty'] = 20;
            $_SESSION['cart'][$id] = $newProduct[$id];
        } else {
            if(array_key_exists($id,$_SESSION['cart'])) {
                $_SESSION['cart'][$id]['qty'] += 1;
            } else {
                $newProduct[$id]['qty'] = 20;
                $_SESSION['cart'][$id] = $newProduct[$id];
            }
        }
        \Yii::$app->getSession()->setFlash('success', 'Bạn vừa thêm sản phẩm vào giỏ hàng thành công !');
        $this->redirect(['cart/index']);
    }

    public function actionUpdate(){

        $session = Yii::$app->session;
        $data = $session->get('cart');
        $request = Yii::$app->request;
        $id = $request->get('id');

        if($request->isGet){
            foreach ($_GET['soluong'] as $key=>$val) {
                foreach ($_GET['id'] as $key1 => $value) {
                    if($val >= 20) {
                        if($key == $key1){
                            $data[$value]['qty'] = $val;
                        }
                    }else{
                        \Yii::$app->getSession()->setFlash('error', 'Chúng tôi chỉ ship đơn hàng với số lượng mỗi sản phẩm từ 20 trở lên !');
                    }
                }
            }
            \Yii::$app->getSession()->setFlash('success', 'Cập nhật giỏ hàng thành công !');
            $this->redirect(['cart/index']);
        }else{
            echo "update failed !";
        }
    }

    public function actionCheckout(){
        $this->layout = 'cart-checkout';
        $request = Yii::$app->request;
        if($request->isPost){
            if($_POST['radio'] == 'Tôi là khách hàng mới'){
                $this->redirect(['cart/checkout1customer']);
            }else{
                if (Yii::$app->user->isGuest){
                    $this->redirect(['cart/login']);
                }else{
                    $this->redirect(['cart/checkout1member']);
                }
                
            }
        }

        return $this->render('checkout');
    }

    public function actionCheckout1member(){

        $this->layout = 'cart-checkout';
        $session = Yii::$app->session;
        $data = $session->get('cart');
        $request = Yii::$app->request;

        $model = new User();
        $new_email = Yii::$app->user->identity->email;
        $model1 = User::find()->where(['deleted'=>0,'email'=>$new_email])->one();
        if($request->isPost){
            $csrf = Yii::$app->request->csrfToken;
            $data = $_POST['User'];
            $model1->name = $data['name'];
            $model1->address = $data['address'];
            $model1->ship_address = $data['ship_address'];
            $model1->phone = $data['phone'];
            $model1->accessToken = $csrf;
            if($model1->save()){
                $this->redirect(['cart/checkout2customer','new_email'=>$new_email]);
            }
        }
        return $this->render('checkout1member',['model'=>$model]);
    }

    public function actionCheckout1customer(){
        $this->layout = 'cart-checkout';
        $model = new User();
        $request = Yii::$app->request;
        if($request->isGet){
            return $this->render('checkout1customer',['model'=>$model]);
        }else{
            $data = $_POST['User'];
            $new_email = $data['email'];
            $model1 = User::find()->where(['deleted'=>0,'email'=>$new_email])->one();
            if(isset($model1)){
                $model1->email = $new_email;
                $model1->name = $data['name'];
                $model1->address = $data['address'];
                $model1->ship_address = $data['ship_address'];
                $model1->phone = $data['phone'];
                if($model1->save()){
                    $this->redirect(['cart/checkout2customer','new_email'=>$new_email]);
                }
            }else{
                $model->load(Yii::$app->request->post());
                $model->password = 'null';
                if($model->save()){
                    $this->redirect(['cart/checkout2']);
                }
            }
        }
        
    }

    public function actionCheckout2(){
        $this->layout = 'cart-checkout';
        $request = Yii::$app->request;

        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $session = Yii::$app->session;
        $data = $session->get('cart');
        $user = User::find()->where(['deleted'=>0])->orderBy('user_id DESC')->limit(1)->one();

        $total = 0;
        foreach($data as $value){
            $total += ($value["price"]*$value["qty"]);
        }

        if($request->isPost){
            $order = new Order();
            $order->user_id = (int)$user->user_id;
            $order->payment_method = $_POST['radio'];
            $order->payment_date = '00-00-0000 - 00:00:00';
            $order->order_date = date('d/m/Y - H:i:s');
            $order->ship_date = date('d/m/Y',strtotime( '+7 days' ));
            $order->total = $total;
            $order->save();

            $oid = Order::find()->where(['user_id'=>$order->user_id,'deleted'=>0])->orderBy('order_id DESC')->limit(1)->one();
            foreach($data as $value){
                $order_dt = new Order_Detail();
                $order_dt->order_id = $oid->order_id;
                $order_dt->pro_id = $value->pro_id;
                $order_dt->name = $value->name;
                $order_dt->price_newest = (($value->price)-($value->price*$value->discount)/100);
                $order_dt->quantity = $value->qty;
                if($order_dt->save()){
                    $this->redirect(['cart/checkout3']);
                }
            }
        }
        $order = Order::find()->where(['deleted'=>0])->orderBy('order_id DESC')->limit(1)->one();
        $order_id = $order->order_id;

        return $this->render('checkout2',['oid'=>$order_id,'total'=>$total]);
    }

    public function actionCheckout2customer(){
        $this->layout = 'cart-checkout';
        $request = Yii::$app->request;

        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $session = Yii::$app->session;
        $data = $session->get('cart');

        $new_email = $_GET['new_email'];
        $user = User::find()->where(['deleted'=>0,'email'=>$new_email])->one();

        $total = 0;
        foreach($data as $value){
            $total += ((($value["price"])-($value["price"]*$value["discount"])/100)*$value["qty"]);
        }

        if($request->isPost){
            $order = new Order();
            $order->user_id = (int)$user->user_id;
            $order->payment_method = $_POST['radio'];
            $order->payment_date = '00-00-0000 - 00:00:00';
            $order->order_date = date('d/m/Y - H:i:s');
            $order->ship_date = date('d/m/Y',strtotime( '+7 days' ));
            $order->total = $total;
            $order->save();

            $oid = Order::find()->where(['user_id'=>$order->user_id,'deleted'=>0])->orderBy('order_id DESC')->limit(1)->one();
            foreach($data as $value){
                $order_dt = new Order_Detail();
                $order_dt->order_id = $oid->order_id;
                $order_dt->pro_id = $value->pro_id;
                $order_dt->name = $value->name;
                $order_dt->price_newest = (($value->price)-($value->price*$value->discount)/100);
                $order_dt->quantity = $value->qty;
                if($order_dt->save()){
                    $this->redirect(['cart/checkout3customer','new_email'=>$new_email]);
                }
            }
        }
        $order = Order::find()->where(['deleted'=>0])->orderBy('order_id DESC')->limit(1)->one();
        $order_id = $order->order_id;

        return $this->render('checkout2customer',['oid'=>$order_id,'total'=>$total]);
    }

    public function actionCheckout3(){
        $this->layout = 'cart-checkout';
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        $data = $session->get('cart');
            
        $user = User::find()->where(['deleted'=>0])->orderBy('user_id DESC')->limit(1)->one();
        $user_id = $user->user_id;
        $new_email = $user->email;

        $order = Order::find()->where(['deleted'=>0])->orderBy('order_id DESC')->limit(1)->one();
        $order_id = $order->order_id;
        $ship_date = $order->ship_date;

        $email = \Yii::$app->mailer->compose()
->setTo($user->email)
->setFrom([\Yii::$app->params['adminEmail'] => 'Admin-VPP2000'])
->setSubject('Xác nhận đơn hàng #VPP'.$order_id)
->setTextBody("Cảm ơn quý khách ". $user->name ." đã mua hàng tại VPP2000 !
Mã hóa đơn của bạn: VPP".$order_id."
Thông tin người mua và địa chỉ giao hàng của đơn hàng:
- Tên người mua: ".$user->name."
- Địa chỉ email: ".$new_email."
- Số điện thoại: 0".$user->phone."
- Địa chỉ giao hàng: ".$user->ship_address."
Tổng tiền phải thanh toán: ".number_format($order->total)." vnđ")
            ->send();

        $session->destroy();

        return $this->render('checkout3',['email'=>$new_email,'order_id'=>$order_id,'data'=>$data,'ship_date'=>$ship_date]);
    }

    public function actionCheckout3customer(){
        $this->layout = 'cart-checkout';
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        $data = $session->get('cart');
            
        $new_email = $_GET['new_email'];
        $user = User::find()->where(['deleted'=>0,'email'=>$new_email])->one();
        $user_id = $user->user_id;
        $n_email = $user->email;

        $order = Order::find()->where(['deleted'=>0])->orderBy('order_id DESC')->limit(1)->one();
        $order_id = $order->order_id;
        $ship_date = $order->ship_date;

        $email = \Yii::$app->mailer->compose()
->setTo($user->email)
->setFrom([\Yii::$app->params['adminEmail'] => 'Admin-VPP2000'])
->setSubject('Xác nhận đơn hàng #VPP'.$order_id)
->setTextBody("Cảm ơn quý khách ". $user->name ." đã mua hàng tại VPP2000 !
Mã hóa đơn của bạn: VPP".$order_id."
Thông tin người mua và địa chỉ giao hàng của đơn hàng:
- Tên người mua: ".$user->name."
- Địa chỉ email: ".$new_email."
- Số điện thoại: 0".$user->phone."
- Địa chỉ giao hàng: ".$user->ship_address."
Tổng tiền phải thanh toán: ".number_format($order->total)." vnđ")
            ->send();

        $session->destroy();

        return $this->render('checkout3',['email'=>$n_email,'order_id'=>$order_id,'data'=>$data,'ship_date'=>$ship_date]);
    }

    public function actionLogin(){
        $this->layout = 'cart-login';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['cart/checkout1member']);
        }

        return $this->render('login',['model'=>$model]);
    }

    public function actionSignup(){
        $this->layout = 'cart-signup';
        $request = Yii::$app->request;
        $model = new Signup();
        if ($request->isPost) {
            $new_email = $_POST['Signup']['email'];
            $user = User::find()->where(['deleted'=>0,'email'=>$new_email])->one();
            if(isset($user)){
                Yii::$app->getSession()->setFlash('error','Email đã tồn tại !');
                return $this->redirect(['cart/signup']);
            }else{
                $model->load(Yii::$app->request->post());
                $user = new User();
                $user->email = $model->email;
                $user->password = \Yii::$app->security->generatePasswordHash($model->password);
                if ($user->save()){
                    $this->redirect(['cart/checkout']);
                }
            }
        }

        return $this->render('signup',['model'=>$model]);
    }

}
