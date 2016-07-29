<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    public static function tableName() {
        return 'user';
    }

    public static function findIdentity($id)
    {
        return static::findOne(['user_id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token]);
    }

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    public function getId()
    {
        return $this->user_id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function validatePassword($password)
    {
         return sha1($password, $this->password);
    }

    public function rules()
    {
        return [
            ['email','email','message'=>'Email không đúng định dạng'],
            ['email','required','message'=>'Email không được để trống'],
            ['password','required'],
            ['name','required','message'=>'Họ tên không được để trống'],
            ['address','required','message'=>'Địa chỉ nhà không được để trống'],
            ['ship_address','required','message'=>'Địa chỉ giao hàng không được để trống'],
            ['phone','required','message'=>'Số điện thoại không được để trống'],
            [['name','address','ship_address'],'string'],
            ['phone', 'number'],
        ];
    }
    
    public function attributeLabels(){
    	return [
            'email' => 'Địa chỉ email',
            'name' => 'Họ và tên',
            'address' => 'Địa chỉ nhà',
            'ship_address' => 'Địa chỉ giao hàng',
            'phone' => 'Số điện thoại',
        ];
    }
    
}