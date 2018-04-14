<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this View */

$this->beginPage(); ?>

    <!DOCTYPE html>
    <html lang="<? Yii::$app->language; ?>">

    <head>
        <meta charset="UTF-8"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title); ?></title>
        <?= $this->head(); ?>
    </head>

    <?= $this->render('homeLayoutPartials/headerContent'); ?>
    <?= $this->beginBody(); ?>
    <?= $content; ?>
    <?= $this->endBody(); ?>
    </html>

<?= $this->endPage(); ?>


