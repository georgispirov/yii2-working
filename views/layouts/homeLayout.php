<?php

use app\assets\HomeAsset;
use app\helpers\UserAuthenticationProcessHelper;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $content string */

HomeAsset::register($this);

$this->beginPage(); ?>

<!DOCTYPE html>
<html lang="<? Yii::$app->language; ?>">

<head>
    <meta charset="UTF-8"/>
    <title><?= Html::encode($this->title); ?></title>
    <?= $this->head(); ?>
</head>

<?= $this->beginBody(); ?>

<?= $this->render('homeLayoutPartials/headerContent') ?>
<?= $this->render('homeLayoutPartials/generateSidenavMenu') ?>
<?= $this->render('homeLayoutPartials/malavitaBodyLayout') ?>
<?php
    if (UserAuthenticationProcessHelper::isUserAuthenticated()) {
        echo $this->render('homeLayoutPartials/heroStats');
    }
?>

<?= $content; ?>

<?= $this->endBody(); ?>
</html>

<?= $this->endPage(); ?>

