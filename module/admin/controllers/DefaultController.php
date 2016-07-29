<?php

namespace app\module\admin\controllers;

use app\module\admin\models\Category;
use app\module\admin\models\Product;
use app\module\admin\models\Order;
use app\module\admin\models\Order_Detail;
use app\module\admin\models\LoginForm;
use yii\data\Pagination;
use Yii;
use yii\web\Controller;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\module\admin\models\AccessRules;

class DefaultController extends \yii\web\Controller
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
    	$this->layout = 'admin';

        if (Yii::$app->user->isGuest){
            $this->redirect(['default/login']);
        }else{
            $request = Yii::$app->request;

            $data = Order::find()->where(['deleted'=>0])->all();
            $data1 = Order::find()->where(['deleted'=>0]);
            $pages = new Pagination([
                'totalCount' => $data1->count(),
                'pageSize'=>10
            ]);
            $models = $data1
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

            return $this->render('index',['models'=>$models, 'pages' => $pages]);
        }
    }

    public function actionFilter(){
        $request = Yii::$app->request;
        if($request->isAjax){
            if(isset($_POST['select'])){
                $data = $_POST['select'];
                $model = Order::find()->where(['deleted'=>0,'user_id'=>$data])->all();
                return \yii\helpers\Json::encode($model);
            }
        }
    }

    public function actionDelete()
    {
    	$request = Yii::$app->request;
        if($request->isGet){
        	$order_id = $request->get('id');
        	$model = Order::findOne($order_id);
        	$model->deleted = 1;
        	if($model->save()){
                \Yii::$app->getSession()->setFlash('success', 'Xóa đơn hàng thành công !');
                $this->redirect(['order/index']);
            }
        }else{
            var_dump($_POST['data']);die;
        }
    }

    public function actionThem(){
        $this->layout = 'admin';
        if (Yii::$app->user->isGuest){
            $this->redirect(['default/login']);
        }else{
            $request = Yii::$app->request;
            if($request->isPost){
                $model = new Order();
                $model->user_id = (int)$_POST['user_id'];
                $model->payment_method = $_POST['payment_method'];
                $model->payment_info = $_POST['payment_info'];
                $model->payment_date = $_POST['payment_date'];
                $model->ship_date = $_POST['ship_date'];
                $model->order_date = $_POST['order_date'];
                $model->message = $_POST['message'];
                $model->total = $_POST['total'];
                $model->order_status = $_POST['order_status'];
                if($model->save()){
                    \Yii::$app->getSession()->setFlash('success', 'Thêm mới hóa đơn thành công !');
                    $this->redirect(['default/index']);
                }
            }

            return $this->render('them');
        }
    }

    public function actionSua()
    {
    	$this->layout = 'admin';
        if (Yii::$app->user->isGuest){
            $this->redirect(['default/login']);
        }else{
            $request = Yii::$app->request;
            $order_id = $request->get('id');
            $model = Order::findOne($order_id);
            if($request->isGet){
                return $this->render('sua',['model'=>$model]);
            }else{
                $model->user_id = (int)$_POST['user_id'];
                $model->payment_method = $_POST['payment_method'];
                $model->payment_info = $_POST['payment_info'];
                $model->payment_date = $_POST['payment_date'];
                $model->ship_date = $_POST['ship_date'];
                $model->order_date = $_POST['order_date'];
                $model->message = $_POST['message'];
                $model->total = $_POST['total'];
                $model->order_status = $_POST['order_status'];
                if($model->save()){
                    \Yii::$app->getSession()->setFlash('success', 'Cập nhật hoá đơn thành công !');
                    $this->redirect(['default/index']);
                }
            }
        }
    }

    public function actionXemchitiet(){
        $this->layout = 'admin';
        if (Yii::$app->user->isGuest){
            $this->redirect(['default/login']);
        }else{
            $request = Yii::$app->request;
            $order_id = $request->get('id');
            $model = Order::findOne($order_id);
            $oid = $model->order_id;
            $listOrd = Order_Detail::find()->where(['order_id'=>$oid])->all();
            $listOrd1 = Order_Detail::find()->where(['order_id'=>$oid]);

            $pages = new Pagination([
                'totalCount' => $listOrd1->count(),
                'pageSize'=>7
            ]);
            $models = $listOrd1
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

            return $this->render('xem',['models'=>$models, 'pages'=>$pages,'oid'=>$oid]);
        }
    }
    
    public function actionLogin()
    {
        $this->layout = 'admin-login';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        // if(Yii::$app->request->isPost){
        //     $model->load(Yii::$app->request->post());
        //     var_dump(\Yii::$app->security->generatePasswordHash($model->password));die;
        // }
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['default/index']);
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    
}