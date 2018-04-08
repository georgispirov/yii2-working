<?php

use app\models\Gangster;
use yii\web\View;

/* @var $this View */ ?>

<div class="hero-stats" style="float: right">
    <table>
        <tbody>
            <td><?= Gangster::getGangsterUsername(); ?></td>
        </tbody>
    </table>
</div>
