<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $pro_id
 * @property integer $cat_id
 * @property string $name
 * @property string $description
 * @property string $price
 * @property string $image
 * @property integer $is_new
 * @property string $status
 * @property integer $deleted
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    public $qty;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_id', 'name', 'description', 'price', 'image'], 'required'],
            [['cat_id', 'is_new', 'deleted'], 'integer'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['name', 'image', 'status'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pro_id' => 'Pro ID',
            'cat_id' => 'Cat ID',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'image' => 'Image',
            'status' => 'Status',
            'deleted' => 'Deleted',
        ];
    }
}
