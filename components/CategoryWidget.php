<?php
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;
use app\models\Category;

class CategoryWidget extends Widget{
	
	public function init(){
		parent::init();
	}
	
	public function run(){
		$listcate = Category::find()->where(['deleted'=>0])->all();
		return $this->render('category',['listcate'=>$listcate]);
	}
}
?>