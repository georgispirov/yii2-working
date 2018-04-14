<?php

namespace app\models\forms;

use app\models\Gangster;
use ReflectionClass;
use Yii;
use yii\base\Model;

class UpdateProfileForm extends Model
{
    const UPDATE_PROFILE = 'UPDATE_PROFILE';

    public $username;
    public $email;
    public $first_name;
    public $last_name;

    public function rules()
    {
        return [
            'usernameTrim'     => ['username', 'trim'],
            'usernameLength'   => ['username', 'string', 'min' => 6, 'max' => 255],
            'usernameUnique'   => ['username', 'unique', 'targetClass' => Gangster::className(),
                'when' => function (self $model) {
                    return $model->username !== Gangster::getGangsterProperty('username');
                },
                'message'      => 'Потребителското име е заето.'
            ],
            'emailTrim'     => ['email', 'trim'],
            'emailPattern'  => ['email', 'email'],
            'emailUnique'   => ['email', 'unique', 'targetClass' => Gangster::className(),
                'when' => function (self $model) {
                    return $model->email !== Gangster::getGangsterProperty('email');
                },
                'message'   => 'Имейл адресът е зает.'
            ],
            [['first_name', 'last_name'], 'string', 'min' => 2, 'max' => 100]
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::UPDATE_PROFILE] = ['username', 'email', 'first_name', 'last_name'];
        return $scenarios;
    }

    public function update(Gangster $gangster)
    {
        $gangster->setAttributes($this->getAttributes());
        return $gangster->save();
    }

    public function formName()
    {
        return (new ReflectionClass(new Gangster()))->getShortName();
    }
}