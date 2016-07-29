<?php

namespace app\module\admin\models;
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
         return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function rules()
    {   
        return array(
            array('email', 'required'),
            array('email', 'email','message'=>"Email không đúng !"),
            array('email', 'unique'),
            array('name', 'string', 'max'=>50, 'message' => 'Tên không được vượt quá 50 ký tự !'),
            array('phone', 'number', 'message'=>'Số điện thoại chưa đúng định dạng !'),
            array('address','string','max'=>100),
            array('ship_address','string','max'=>100),
        );  
    }
}
