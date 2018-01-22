<?php
namespace app\models\form;

use app\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $phone;
    public $password;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => 'Email already exist.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => User::className(), 'message' => 'Username already exist.'],
            ['phone', 'required'],
            ['phone', 'string', 'max' => 16],
            ['phone', 'unique', 'targetClass' => User::className(), 'message' => 'This phone number already exist.'],
            ['verifyCode', 'captcha'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' =>'Username',
            'email' => 'Email',
            'password' => 'Password',
            'phone' => 'Phone number',
            'verifyCode' => 'Verify code',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     * @throws \yii\base\Exception
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->phone = $this->phone;
            $user->setPassword($this->password);
            $user->generateAuthKey();

            if ($user->save()) {
                return $user;
            }
        }
        return null;
    }
}