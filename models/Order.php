<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $order_id
 * @property integer $customer_id
 * @property string $payment_method
 * @property string $payment_info
 * @property string $message
 * @property string $total
 * @property string $status
 * @property integer $created
 * @property integer $deleted
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'total', 'order_date', 'payment_date', 'ship_date', 'payment_method'], 'required'],
            [['user_id', 'deleted'], 'integer'],
            [['payment_method'], 'string', 'max' => 50],
            [['payment_info', 'message', 'order_status'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'user_id' => 'Customer ID',
            'payment_method' => 'Payment Method',
            'payment_info' => 'Payment Info',
            'message' => 'Message',
            'total' => 'Total',
            'order_status' => 'Status',
            'order_date' => 'Created',
            'payment_date' => 'Payment Date',
            'deleted' => 'Deleted',
        ];
    }
}
