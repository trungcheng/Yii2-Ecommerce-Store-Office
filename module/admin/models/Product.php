<?php

namespace app\module\admin\models;
use Yii;

class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }
    public $fileUpload;
    public $fileEdit;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_id', 'name', 'description', 'price', 'image'], 'required'],
            [['cat_id', 'discount', 'status', 'deleted'], 'integer'],
            [['description'], 'string'],
            [['fileUpload'], 'file'],
            [['fileEdit'], 'file'],
            [['price'], 'number'],
            [['name', 'image'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'pro_id' => 'Pro ID',
            'cat_id' => 'Tên danh mục',
            'name' => 'Tên sản phẩm',
            'description' => 'Mô tả sản phẩm',
            'price' => 'Giá',
            'image' => 'Hình ảnh',
            'discount' => 'Giảm giá (%)',
            'status' => 'Trạng thái',
            'deleted' => 'Deleted',
            'fileUpload' => 'Hình ảnh',
            'fileEdit' => 'Cập nhật hình ảnh'
        ];
    }
}
