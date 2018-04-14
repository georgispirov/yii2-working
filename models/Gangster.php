<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

class Gangster extends Users
{
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [

        ]);
    }

    public function attributeLabels()
    {
        return [
            'username'   => 'Потребителско име',
            'email'      => 'Имейл',
            'first_name' => 'Име',
            'last_name'  => 'Фамилия'
        ];
    }

    public static function getGangsterProperty(string $property)
    {
        $gangster = Users::findOne(Yii::$app->getUser()->getId());
        return $gangster->{$property};
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @return int
     */
    public function getCreatedAt(): int
    {
        return $this->created_at;
    }

    /**
     * @return int
     */
    public function getUpdatedAt(): int
    {
        return $this->updated_at;
    }

    /**
     * @return string
     */
    public function getIpAddress(): string
    {
        return $this->ip_address;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->avatar;
    }
}