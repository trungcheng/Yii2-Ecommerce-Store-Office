<?php

namespace app\module\admin\controllers;

use app\module\admin\models\User;
use yii\data\Pagination;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$this->layout = 'admin';
        if (Yii::$app->user->isGuest){
            $this->redirect(['default/login']);
        }else{
        	$data = User::find()->where(['deleted'=>0])->all();
            return $this->render('index',['model'=>$data]);
        }
    }

    public function actionDelete()
    {
    	$request = Yii::$app->request;
        if($request->isGet){
        	$user_id = $request->get('id');
        	$model = User::findOne($user_id);
        	$model->deleted = 1;
        	if($model->save()){
                \Yii::$app->getSession()->setFlash('success', 'Xóa khách hàng thành công !');
                $this->redirect(['user/index']);
            }
        }else{
            var_dump($_POST['data']);die;
        }
    }

    public function actionThem(){
        $this->layout = 'admin';
        $model = new User();
        if (Yii::$app->user->isGuest){
            $this->redirect(['default/login']);
        }else{
            $request = Yii::$app->request;
            if($request->isPost){
                $model->load(Yii::$app->request->post());
                if($model->save()){
                    \Yii::$app->getSession()->setFlash('success', 'Thêm mới khách hàng thành công !');
                    $this->redirect(['user/index']);
                }
            }

            return $this->render('them',['model'=>$model]);
        }
    }

    public function actionSua()
    {
    	$this->layout = 'admin';
        if (Yii::$app->user->isGuest){
            $this->redirect(['default/login']);
        }else{
        	$request = Yii::$app->request;
        	$user_id = $request->get('id');
        	$model = User::findOne($user_id);
        	if($request->isGet){
        		return $this->render('sua',['model'=>$model]);
        	}else{
        		$newcat = $request->post('User');
        		$model->email = $newcat['email'];
        		$model->name = $newcat['name'];
                $model->address = $newcat['address'];
                $model->ship_address = $newcat['ship_address'];
                $model->phone = $newcat['phone'];
        		if($model->save()){
                    \Yii::$app->getSession()->setFlash('success', 'Cập nhật khách hàng thành công !');
                    $this->redirect(['user/index']);
                }
        	}
        }
    }
}
