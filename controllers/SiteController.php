<?php

namespace app\controllers;

use Yii;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\Signup;
use app\models\Customer;
use app\models\ContactForm;
use app\models\Product;
use app\models\User;
use app\models\Order;
use app\models\Order_Detail;
use yii\data\Pagination;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {

        if (!\Yii::$app->user->isGuest) {
            $email = Yii::$app->user->identity->email;
            $user = User::find()->where(['deleted'=>0,'email'=>$email])->one();
            $user_id = $user->user_id;
            $order = Order::find()->where(['deleted'=>0,'user_id'=>$user_id])->orderBy('order_id DESC')->limit(1)->one();
            if(count($order)>0){
                $order_id = $order->order_id;
                $order_detail = Order_Detail::find()->where(['deleted'=>0,'order_id'=>$order_id])->all();
            }else{
                $order = [];
                $order_detail = [];
            }
        }else{
            $order = [];
            $order_detail = [];
        }

        $listpro_sale = Product::find()->where('discount > 0',['status'=>0,'deleted'=>0])->all();
        $listPro = Product::find()->where(['deleted'=>0]);

        $pagination = new Pagination([
            'defaultPageSize' => 12,
            'totalCount' => $listPro->count()
        ]);

        $total = $listPro->orderBy('pro_id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index',array('order'=>$order,'order_detail'=>$order_detail,'listpro_sale'=>$listpro_sale,'list' => $total,'pagination' => $pagination));
    }

    public function actionSignin(){
        $request = Yii::$app->request;
        $this->layout = 'login';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if($request->isPost){
            $model->load(Yii::$app->request->post());
            $pass = $model->password;
            $user = User::find()->where(['email'=>$model->email,'password'=>sha1($pass),'deleted'=>0])->one();
            if(isset($user)){
                if($user->authKey == 'confirm now !'){
                    Yii::$app->getSession()->setFlash('error','Bạn chưa xác nhận tài khoản đăng ký, vui lòng check mail ngay để xác nhận !');
                    return $this->redirect(['site/signin']);
                }else{
                    $model->login();
                    return $this->goBack();
                }
            }else{
                Yii::$app->getSession()->setFlash('error','Tài khoản hoặc mật khẩu không đúng !');
                return $this->redirect(['site/signin']);
            }
        }

        return $this->render('signin',['model'=>$model]);
    }

    public function actionSignup(){
        $this->layout = 'signup';
        $request = Yii::$app->request;
        $model = new Signup();
        if ($request->isPost) {
            $new_email = $_POST['Signup']['email'];
            $user = User::find()->where(['deleted'=>0,'email'=>$new_email])->one();
            if(isset($user)){
                Yii::$app->getSession()->setFlash('error','Email đã tồn tại !');
                return $this->redirect(['site/signup']);
            }else{
                $user = new User();
                $model->load($request->post());
                $user->email = $model->email;
                $user->name = '(empty)';
                $user->address = '(empty)';
                $user->ship_address = '(empty)';
                $user->phone = 0;
                $user->password = sha1($model->password);
                $user->authKey = 'confirm now !';
                if ($user ->save()){
                    $email = \Yii::$app->mailer->compose()
                    ->setTo($user->email)
                    ->setFrom([\Yii::$app->params['adminEmail'] => 'Admin-VPP2000'])
                    ->setSubject('Xác nhận đăng ký thành viên tại VPP2000')
                    ->setTextBody("
                    Truy cập đường dẫn ".\yii\helpers\Html::a('confirm',
                    Yii::$app->urlManager->createAbsoluteUrl(
                    ['site/confirm','id'=>$user->user_id,'key'=>$user->authKey]
                    ))
                    )
                    ->send();
                    if($email){
                    Yii::$app->getSession()->setFlash('success','Đăng ký tài khoản thành công ! Vui lòng kiểm tra email để xác nhận ngay !');
                    }
                    else{
                    Yii::$app->getSession()->setFlash('error','Có lỗi xảy ra trong quá trình đăng ký ! Vui lòng liên hệ admin ngay !');
                    }
                    return $this->redirect(['site/signin']);
                }else{
                    Yii::$app->getSession()->setFlash('error','Xảy ra lỗi trong quá trình đăng ký !');
                    return $this->redirect(['site/signup']);
                }
            }
        }

        return $this->render('signup',['model'=>$model]);
    }

    public function actionConfirm($id, $key)
    {
        $user = User::find()->where(['user_id'=>$id,'authKey'=>$key,'deleted'=>0,])->one();
        if(!empty($user)){
            $user->authKey = Yii::$app->getSecurity()->generateRandomString();
            $user->save();
            Yii::$app->getSession()->setFlash('success','Xác nhận đăng ký thành công, đăng nhập ngay !');
            return $this->redirect(['site/signin']);
        }
        else{
            Yii::$app->getSession()->setFlash('error','Xác nhận ko thành công !');
            return $this->redirect(['site/signin']);
        }
    }

    public function actionSignout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionForgotpw(){
        $this->layout = 'fotgotpw';
        $request = Yii::$app->request;
        $model = new LoginForm();
        if($request->isPost){
            $confirm_email = $_POST['LoginForm']['email'];
            $user = User::find()->where(['deleted'=>0,'email'=>$confirm_email])->one();
            $email = \Yii::$app->mailer->compose()
                    ->setTo($user->email)
                    ->setFrom([\Yii::$app->params['adminEmail'] => 'Admin-VPP2000'])
                    ->setSubject('Xác nhận thay đổi mật khẩu tại VPP2000')
                    ->setTextBody("
                    Truy cập đường dẫn ".\yii\helpers\Html::a('confirm',
                    Yii::$app->urlManager->createAbsoluteUrl(
                    ['site/confirm1','id'=>$user->user_id,'key'=>$user->authKey]
                    ))
                    )
                    ->send();
            if($email){
                    Yii::$app->getSession()->setFlash('success','Xác nhận email thành công ! Vui lòng kiểm tra email để xác nhận ngay !');
                    }
                    else{
                    Yii::$app->getSession()->setFlash('error','Có lỗi xảy ra trong quá trình đăng ký ! Vui lòng liên hệ admin ngay !');
                    }
                    return $this->goHome();
        }

        return $this->render('forgotpw',['model'=>$model]);
    }

    public function actionConfirm1($id, $key)
    {
        $user = User::find()->where(['user_id'=>$id,'authKey'=>$key,'deleted'=>0,])->one();
        if(!empty($user)){
            Yii::$app->getSession()->setFlash('success','Xác nhận thành công ! Vui lòng điền mật khẩu mới');
            return $this->redirect(['site/newpass']);
        }
        else{
            Yii::$app->getSession()->setFlash('error','Có lỗi xảy ra !');
        }
        return $this->goHome();
    }

    public function actionNewpass(){
        $this->layout = 'shopping-cart';
        $request = Yii::$app->request;
        $model = new Signup();
        if($request->isPost){
            $confirm_email = $_POST['Signup']['email'];
            $newpass = $_POST['Signup']['password'];
            $user = User::find()->where(['deleted'=>0,'email'=>$confirm_email])->one();
            $user->password = \Yii::$app->security->generatePasswordHash($newpass);
            if($user->save()){
                Yii::$app->getSession()->setFlash('success','Đổi mật khẩu thành công !');
                return $this->redirect(['site/newpass']);
            }
        }

        return $this->render('newpass',['model'=>$model]);
    }

    public function actionContact()
    {
    	$this->layout = 'cart-checkout';
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post())) {
            if($model->sendEmail(Yii::$app->params['adminEmail'])){
                Yii::$app->session->setFlash('success','Cảm ơn bạn đã liên hệ với chúng tôi, chúng tôi sẽ phản hồi trong thời gian sớm nhất !');
            }else{
                Yii::$app->session->setFlash('error','Có lỗi xảy ra trong quá trình gửi liên hệ');
            }

            return $this->refresh();
        }else{
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
    	$this->layout = 'cart-checkout';
        return $this->render('about');
    }
    public function actionPolicy()
    {
    	$this->layout = 'layout-site';
        return $this->render('policy');
    }
    public function actionCustomer()
    {
    	$this->layout = 'cart-checkout';
        return $this->render('customer');
    }
    public function actionRecruitment()
    {
    	$this->layout = 'cart-checkout';
        return $this->render('recruitment');
    }
    public function actionService()
    {
    	$this->layout = 'cart-checkout';
        return $this->render('service');
    }
    public function actionPrice()
    {
        $this->layout = 'cart-checkout';
        return $this->render('price');
    }
    public function actionSale()
    {
        $this->layout = 'cart-checkout';
        return $this->render('sale');
    }

    public function actionSearch(){
        $this->layout = 'search-result';
        if (Yii::$app->request->isAjax){
            if(Yii::$app->request->isPost){
                $pro_name = $_POST['pro_name'];
                $this->redirect(['site/search','pro_name'=>$pro_name]);
            }
        }
        return $this->render('search');
    }
}