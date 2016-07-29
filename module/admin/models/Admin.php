<?php

namespace app\module\admin\models;
use Yii;
use yii\db\ActiveRecord;

class Admin extends ActiveRecord implements \yii\web\IdentityInterface
{

    
    public static function tableName() {
        return 'admin';
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * Lay ra user boi accesstoken truyen vao (thuong la tu header cua request)
     **/
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token]);
    }

    /**
     * Lay user dua vao user name truyen vao
     *
     * 
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Lay ra user id dang dang nhap
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Lay ra authkey cua user dang dang nhap
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * check auth key xem user nay co dc dang nhap hay khong
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * check lai password
     *
     **/
    public function validatePassword($password)
    {
         return Yii::$app->security->validatePassword($password, $this->password);
    }
}
