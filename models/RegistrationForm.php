<?php

namespace app\models;

use app\components\EmailAfterRegisterBehavior;
use Yii;
use yii\base\Model;

/**
 * Class RegistrationForm
 * @package app\models
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $re_password
 * @property integer $age
 * @property integer $city_id
 * @property integer $gender_id
 * @property string $ip_address
 * @property integer $created_at
 * @property integer $updated_at
 */
class RegistrationForm extends Model
{
    public $username;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $re_password;
    public $age;
    public $city_id;
    public $gender_id;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['username', 'first_name', 'last_name', 'password' ,
              're_password', 'email', 'age', 'city_id', 'gender_id'], 'required'],
            // username rules
            'usernameTrim'     => ['username', 'trim'],
            'usernameLength'   => ['username', 'string', 'min' => 6, 'max' => 255],
            'usernameUnique'   => ['username', 'unique', 'targetClass' => Users::className(),
                'message'      => 'This username has already been taken'
            ],
            // email rules
            'emailTrim'     => ['email', 'trim'],
            'emailPattern'  => ['email', 'email'],
            'emailUnique'   => ['email', 'unique', 'targetClass' => Users::className(),
                'message'   => 'This email address has already been taken'
            ],
            // password rules
            'passwordLength'   => ['password', 'string', 'min' => 6, 'max' => 25],
            'passwordCompare'  => ['re_password', 'compare', 'compareAttribute' => 'password'],
            // first_name rules
            'first_nameTrim'    => ['first_name', 'trim'],
            'first_nameLength'  => ['first_name', 'string', 'min' => 2, 'max' => 100],
            // last_name rules
            'last_nameTrim'    => ['last_name', 'trim'],
            'last_nameLength'  => ['last_name', 'string', 'min' => 2, 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'user'        => 'Username',
            'password'    => 'Password',
            're_password' => 'Re Password',
            'email'       => 'Email',
            'first_name'  => 'First Name',
            'city_id'     => 'City',
            'gender_id'   => 'Gender',
            'last_name'   => 'Last Name',
        ];
    }

    public function registration()
    {
        if (!$this->validate()) {
            return false;
        }

        $model = new Users();
        $model->setAttributes([
            'username'    => $this->username,
            'first_name'  => $this->first_name,
            'last_name'   => $this->last_name,
            'email'       => $this->email,
            'password'    => Yii::$app->getSecurity()->generatePasswordHash($this->password),
            're_password' => Yii::$app->getSecurity()->generatePasswordHash($this->re_password),
            'city_id'     => $this->city_id,
            'gender_id'   => $this->gender_id,
            'age'         => $this->age
        ]);

        return $model->save() ? $model : null;
    }
}