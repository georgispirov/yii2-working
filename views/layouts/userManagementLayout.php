<?php

use yii\helpers\Html;

$this->beginPage(); ?>

    <!DOCTYPE html>
    <html lang="<? Yii::$app->language; ?>">

    <head>
        <meta charset="UTF-8"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title); ?></title>
        <?= $this->head(); ?>
    </head>

    <?= $this->beginBody(); ?>
    <?= $content; ?>
    <?= $this->endBody(); ?>
    </html>

<?= $this->endPage(); ?>


