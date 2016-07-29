<?php
namespace app\models;
use app\models\User;
use yii\base\Model;
use Yii;

class Signup extends Model
{
    public $email;
    public $password;
    public $confirmPassword;
    public function rules()
    {
        return [
            ['email', 'required','message'=>"Email không được để trống !"],
            ['email', 'email','message'=>"Định dạng email không đúng !"],
            ['password', 'required','message'=>"Mật khẩu không được để trống !"],
            ['password', 'string', 'min' => 6, 'message'=>'Mật khẩu phải ít nhất 6 ký tự !'],
            ['confirmPassword', 'required','message'=>"Xác nhận mật khẩu không được để trống"],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password','message'=>"Xác nhận mật khẩu phải giống với mật khẩu"],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Địa chỉ email',
            'password' => 'Mật khẩu',
            'confirmPassword' => 'Xác nhận mật khẩu',
        ];
    }
}