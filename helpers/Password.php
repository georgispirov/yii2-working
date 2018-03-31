<?php

namespace app\helpers;

use Yii;
use yii\base\BaseObject;

class Password extends BaseObject
{

    /**
     * @param $password
     * @return string
     */
    public static function hash($password)
    {
        return Yii::$app->security->generatePasswordHash($password, Yii::$app->getModule('user')->cost);
    }

    /**
     * @param $password
     * @param $hash
     * @return bool
     */
    public static function validate($password, $hash)
    {
        return Yii::$app->security->validatePassword($password, $hash);
    }
}