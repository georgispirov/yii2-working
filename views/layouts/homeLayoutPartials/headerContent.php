<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\View;

/* @var $this yii\web\View */

$headerImage = Yii::$app->runAction('image/get-image', [
    'file'   => Yii::$app->getBasePath() . '/images/headerImage.jpg',
    'width'  => 100,
    'height' => 100
]);

echo Html::a($headerImage, Url::to(['home/index']));

?>

