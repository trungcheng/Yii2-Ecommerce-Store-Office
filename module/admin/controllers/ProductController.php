<?php
namespace app\module\admin\controllers;

use app\module\admin\models\Category;
use app\module\admin\models\Product;
use yii\data\Pagination;
use Yii;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class ProductController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$this->layout = 'admin';
        if (Yii::$app->user->isGuest){
            $this->redirect(['default/login']);
        }else{
        	$data = Product::find()->where(['deleted'=>0])->all();
        	$model = Category::find()->where(['deleted'=>0])->all();
        	$data1 = Product::find()->where(['deleted'=>0]);
        	$pages = new Pagination([
        		'totalCount' => $data1->count(),
        		'pageSize'=>7
        	]);
        	$models = $data1
        		->offset($pages->offset)
        		->limit($pages->limit)
        		->all();
            return $this->render('index',['models'=>$models, 'pages' => $pages,'model'=>$model]);
        }
    }

    public function actionXoa()
    {
        $request = Yii::$app->request;
        $pro_id = $request->get('id');
        $model = Product::findOne($pro_id);
        $model->deleted = 1;
        if($model->save()){
            \Yii::$app->getSession()->setFlash('success', 'Xóa sản phẩm thành công !');
            $this->redirect(['product/index']);
        }
    }

    public function actionThem()
    {
        $this->layout = 'admin';
        if (Yii::$app->user->isGuest){
            $this->redirect(['default/login']);
        }else{
            $request = Yii::$app->request;
            $newPro = new Product();
            
            if($request->isGet){
                $ltCate = Category::find()->all();
                return $this->render('them',array('newPro' => $newPro,'ltCate' => $ltCate));
            }
            else
            {
                $newPro->load($request->post());
                $newPro->deleted = 0;
                $newPro->save();

                $newName = 'Pro - '.$newPro->pro_id;

                $newPro->fileUpload = UploadedFile::getInstance($newPro, 'fileUpload');
                if($newPro->fileUpload){
                    $newPro->fileUpload->saveAs('images/' . $newName . '.' . $newPro->fileUpload->extension);
                    $newPro->image = ('images/' . $newName . '.' . $newPro->fileUpload->extension); 
                }
                
                if($newPro->save()){
                    \Yii::$app->getSession()->setFlash('success', 'Thêm mới sản phẩm thành công !');
                    return $this->redirect(['product/index']);
                }
                else{
                    echo "Thêm ko thành công !";     
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
            $edit_id = $request->get('id');
            $newPro = Product::findOne($edit_id);
            $ltCate = Category::find()->all();
            if($request->isGet){
                return $this->render('sua',array('newPro' => $newPro, 'ltCate' => $ltCate));
            }
            else{
                $newPro->load($request->post());
                $newPro->deleted = 0;
                $newPro->save();

                $newName = 'Pro - '.$edit_id;

                $newPro->fileEdit = UploadedFile::getInstance($newPro, 'fileEdit');
                if($newPro->fileEdit){
                    $newPro->fileEdit->saveAs('images/' . $newName . '.' . $newPro->fileEdit->extension);
                    $newPro->image = ('images/' . $newName . '.' . $newPro->fileEdit->extension);   
                }
                if($newPro->save()){
                    \Yii::$app->getSession()->setFlash('success', 'Sửa sản phẩm thành công !');
                    return $this->redirect(['product/index']);
                }
                else{
                    echo "Sửa ko thành công !";       
                }
            }
        }
    }
}
