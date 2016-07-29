<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders_detail".
 *
 * @property integer $order_detail_id
 * @property integer $order_id
 * @property integer $pro_id
 * @property string $name
 * @property string $price_newest
 * @property integer $quantity
 * @property integer $deleted
 */
class Order_Detail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'pro_id', 'name', 'price_newest', 'quantity'], 'required'],
            [['order_id', 'pro_id', 'quantity', 'deleted'], 'integer'],
            [['price_newest'], 'number'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_detail_id' => 'Order Detail ID',
            'order_id' => 'Order ID',
            'pro_id' => 'Pro ID',
            'name' => 'Name',
            'price_newest' => 'Price Newest',
            'quantity' => 'Quantity',
            'deleted' => 'Deleted',
        ];
    }
}
