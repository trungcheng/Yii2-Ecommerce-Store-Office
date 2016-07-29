<?php

namespace app\controllers;
use Yii;
use app\models\News;
use yii\data\Pagination;

class NewController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$this->layout = 'news';
    	$model = News::find()->where(['deleted'=>0])->all();
    	$listnew = News::find()->where(['deleted'=>0]);

    	$pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $listnew->count()
        ]);

        $total = $listnew->orderBy('news_id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index',['model'=>$total,'pagination'=>$pagination]);
    }

    public function actionDetail(){
    	$this->layout = 'news';
    	$request = Yii::$app->request;
    	$new_id = $request->get('id');

    	$model = News::find()->where(['deleted'=>0,'news_id'=>$new_id])->one();

    	return $this->render('detail',['model'=>$model]);
    }

}
