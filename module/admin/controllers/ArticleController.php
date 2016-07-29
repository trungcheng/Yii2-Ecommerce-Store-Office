<?php
namespace app\module\admin\controllers;

use app\module\admin\models\News;
use app\module\admin\models\Product;
use yii\data\Pagination;
use Yii;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class ArticleController extends \yii\web\Controller
{
	public function actionIndex()
    {
    	$this->layout = 'admin';
        if (Yii::$app->user->isGuest){
            $this->redirect(['default/login']);
        }else{
        	$data = News::find()->where(['deleted'=>0])->all();
        	$data1 = News::find()->where(['deleted'=>0]);
        	$pages = new Pagination([
        		'totalCount' => $data1->count(),
        		'pageSize'=>5
        	]);
        	$models = $data1
        		->offset($pages->offset)
        		->limit($pages->limit)
        		->all();
            return $this->render('index',['models'=>$models, 'pages' => $pages,'data'=>$data]);
        }
    }

    public function actionThem(){
        $this->layout = 'admin';

        $request = Yii::$app->request;
        $model = new News();
        if($request->isGet){
            return $this->render('them',['model'=>$model]);
        }else{
                $model->load($request->post());
                $model->deleted = 0;
                $model->save();

                $newName = 'Article-'.$model->news_id;

                $model->fileUpload = UploadedFile::getInstance($model, 'fileUpload');
                if($model->fileUpload){
                    $model->fileUpload->saveAs('images/' . $newName . '.' . $model->fileUpload->extension);
                    $model->news_image = ('images/' . $newName . '.' . $model->fileUpload->extension); 
                }
                
                if($model->save()){
                    \Yii::$app->getSession()->setFlash('success', 'Thêm mới bài viết thành công !');
                    return $this->redirect(['article/index']);
                }
                else{
                    echo "Thêm ko thành công !";     
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
            $edit_id = $request->get('id');
            $model = News::findOne($edit_id);
            if($request->isGet){
                return $this->render('sua',array('model' => $model));
            }
            else{
                $model->load($request->post());
                $model->deleted = 0;
                $model->save();

                $newName = 'Article-'.$edit_id;

                $model->fileEdit = UploadedFile::getInstance($model, 'fileEdit');
                if($model->fileEdit){
                    $model->fileEdit->saveAs('images/' . $newName . '.' . $model->fileEdit->extension);
                    $model->news_image = ('images/' . $newName . '.' . $model->fileEdit->extension);   
                
	                if($model->save()){
	                    \Yii::$app->getSession()->setFlash('success', 'Sửa bài viết thành công !');
	                    return $this->redirect(['article/index']);
	                }
	                else{
	                    echo "Sửa ko thành công !";       
	                }
                }
            }
        }
    }
}

?>