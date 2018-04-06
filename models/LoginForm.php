<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $_rememberMe;

    private $user;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['username', 'password'], 'string'],
            ['_rememberMe', 'boolean'],
            ['password', 'validatePassword']
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function login()
    {
        return Yii::$app->getUser()->login($this->getUser(), $this->_rememberMe ? 3600 * 24 * 30 : 0);
    }

    /**
     * @return Users|null
     */
    protected function getUser()
    {
        if (null === $this->user) {
            $this->user = Users::find()->byUsername($this->username);
        }

        return $this->user;
    }
}