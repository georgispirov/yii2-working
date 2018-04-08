<?php

use app\helpers\UserAuthenticationProcessHelper;
use kartik\sidenav\SideNav;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */

echo SideNav::widget([
    'type' => SideNav::TYPE_INFO,
    'options' => ['class' => 'col-xs-2'],
    'items' => [
        [
            'url'     => Url::to(['home/index']),
            'label'   => 'Квартала',
            'icon'    => 'home',
            'visible' => UserAuthenticationProcessHelper::isUserAuthenticated()
        ],
        [
            'label'   => 'Помощ',
            'icon'    => 'question-sign',
            'visible' => UserAuthenticationProcessHelper::isUserAuthenticated()
        ],
        [
            'url' => UserAuthenticationProcessHelper::generateLinkDependentOnAuthUser(),
            'icon' => 'log-out',
            'label' => UserAuthenticationProcessHelper::generateLabelForLoginLogout(),
        ]
    ],
]);