<?php
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class SlideshowWidget extends Widget{
	
	public function init(){
		parent::init();
	}
	
	public function run(){
		return $this->render('slideshow');
	}
}
?>