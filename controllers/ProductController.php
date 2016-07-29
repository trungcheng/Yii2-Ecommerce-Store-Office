<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use app\models\Comment;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\data\Pagination;

class ProductController extends \yii\web\Controller
{
	public function actionIndex()
	{
		$listPro = Product::find()->where(['deleted'=>0])->all();
		return $this->render('index', array('list' => $listPro));
	}

	public function actionListproduct(){
		$request = Yii::$app->request;
		$view_id = $request->get('id');
		$newCate = Category::findOne($view_id);
		$listPro = Product::find()->where(['cat_id'=> $view_id,'deleted'=>0,'status'=>0]);
		$listpro_new = Product::find()->where(['status'=>0,'deleted'=>0])->orderBy('pro_id DESC')->limit(10)->all();

		$pagination = new Pagination([
            'defaultPageSize' => 8,
            'totalCount' => $listPro->count()
        ]);

        $total = $listPro->orderBy('cat_id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

		return $this->render('listproduct', array('listpro_new' => $listpro_new,'list' => $total,'name' => $newCate->name,'pagination' => $pagination));
	}

	public function actionDetail(){
		$this->layout = 'layout-site';
		$request = Yii::$app->request;
		$detail_id = $request->get('id');
		$detailPro = Product::findOne($detail_id);
		$cat_id = $detailPro->cat_id;
		$proAll = Product::find()->where(['cat_id'=>$cat_id])->all();
		$cat_name = Category::findOne($cat_id);

		return $this->render('detail', ['proAll'=>$proAll,'cat_name'=>$cat_name->name,'detailPro' => $detailPro]);
	}
}
?>