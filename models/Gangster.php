<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

class Gangster extends Users
{
    public function rules()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [

        ]);
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [

        ]);
    }

    public static function getGangsterUsername()
    {
        $gangster = Users::findOne(Yii::$app->getUser()->getId());
        return $gangster->username;
    }
}