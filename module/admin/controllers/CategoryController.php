<?php

namespace app\module\admin\controllers;

use app\module\admin\models\Category;
use app\module\admin\models\Product;
use yii\data\Pagination;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class CategoryController extends \yii\web\Controller
{

    public function actionIndex()
    {
    	$this->layout = 'admin';
        if (Yii::$app->user->isGuest){
            $this->redirect(['default/login']);
        }else{
    	   $data = Category::find()->where(['deleted'=>0])->all();
            return $this->render('index',['model'=>$data]);
        }
    }

    public function actionDelete()
    {
    	$request = Yii::$app->request;
        if($request->isGet){
        	$cat_id = $request->get('id');
        	$model = Category::findOne($cat_id);
        	$model->deleted = 1;
        	if($model->save()){
                \Yii::$app->getSession()->setFlash('success', 'Xóa danh mục thành công !');
                $this->redirect(['category/index']);
            }
        }else{
            var_dump($_POST['data']);die;
        }
    }

    public function actionThem()
    {
    	$this->layout = 'admin';
        if (Yii::$app->user->isGuest){
            $this->redirect(['default/login']);
        }else{
        	$model = new Category();
        	$request = Yii::$app->request;
        	if($request->isGet){
        		return $this->render('them',['model'=>$model]);
        	}else{
        		$model->load(Yii::$app->request->post());
        		if($model->save()){
                    \Yii::$app->getSession()->setFlash('success', 'Thêm mới danh mục thành công !');
        			$this->redirect(['category/index']);
        		}
        	}
        }
    }

    public function actionSua()
    {
    	$this->layout = 'admin';
        if (Yii::$app->user->isGuest){
            $this->redirect(['default/login']);
        }else{
        	$request = Yii::$app->request;
        	$cat_id = $request->get('id');
        	$model = Category::findOne($cat_id);
        	if($request->isGet){
        		return $this->render('sua',['model'=>$model]);
        	}else{
        		$newcat = $request->post('Category');
        		$model->name = $newcat['name'];
        		$model->description = $newcat['description'];
        		if($model->save()){
                    \Yii::$app->getSession()->setFlash('success', 'Cập nhật danh mục thành công !');
                    $this->redirect(['category/index']);
                }
        	}
        }
    }

    public function actionXem()
    {
    	$this->layout = 'admin';
        if (Yii::$app->user->isGuest){
            $this->redirect(['default/login']);
        }else{
        	$request = Yii::$app->request;
        	$cat_id = $request->get('id');
        	$model = Category::findOne($cat_id);
        	$cid = $model->cat_id;
        	$cat_name = $model->name;
        	$listPro = Product::find()->where(['cat_id'=>$cid])->all();
        	$listPro1 = Product::find()->where(['cat_id'=>$cid]);

        	$pages = new Pagination([
        		'totalCount' => $listPro1->count(),
        		'pageSize'=>7
        	]);
        	$models = $listPro1
        		->offset($pages->offset)
        		->limit($pages->limit)
        		->all();

        	return $this->render('xem',['models'=>$models, 'pages'=>$pages,'cat_name'=>$cat_name]);
        }
    }
}
