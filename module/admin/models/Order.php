<?php

namespace app\module\admin\models;
use Yii;

class Order extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'orders';
    }

    public function rules()
    {
        return [
            [['user_id', 'payment_method', 'ship_date', 'order_date', 'total'], 'required'],
            [['user_id', 'deleted'], 'integer'],
            [['payment_date', 'ship_date', 'order_date'], 'safe'],
            [['total'], 'number'],
            [['payment_method'], 'string', 'max' => 50],
            [['payment_info', 'message', 'order_status'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'user_id' => 'Mã khách hàng',
            'payment_method' => 'Phương thức thanh toán',
            'payment_info' => 'Thông tin thanh toán',
            'payment_date' => 'Ngày thanh toán',
            'ship_date' => 'Ngày giao hàng',
            'order_date' => 'Ngày đặt hàng',
            'message' => 'Ghi chú',
            'total' => 'Tổng tiền',
            'order_status' => 'Tình trạng',
            'deleted' => 'Deleted',
        ];
    }
}

?>
