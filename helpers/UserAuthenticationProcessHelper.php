<?php

namespace app\helpers;

use Yii;
use yii\base\BaseObject;
use yii\helpers\Url;

class UserAuthenticationProcessHelper extends BaseObject
{
    public static function isUserAuthenticated()
    {
        return !Yii::$app->getUser()->getIsGuest();
    }

    public static function generateLinkDependentOnAuthUser()
    {
        if (self::isUserAuthenticated()) {
            return Url::to(['user-management/logout']);
        }
        return Url::to(['user-management/login']);
    }

    public static function generateLabelForLoginLogout()
    {
        if (self::isUserAuthenticated()) {
            return 'Изход';
        }
        return 'Вход';
    }
}