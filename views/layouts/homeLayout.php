<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $content string */

$this->beginPage(); ?>

<!DOCTYPE html>
<html lang="<? Yii::$app->language; ?>">

<head>
    <meta charset="UTF-8"/>
    <title><?= Html::encode($this->title); ?></title>
    <?= $this->head(); ?>
</head>

<?= $this->beginBody(); ?>
<header>Application</header>
<?= $content; ?>
<?= $this->endBody(); ?>
</html>

<?= $this->endPage(); ?>

