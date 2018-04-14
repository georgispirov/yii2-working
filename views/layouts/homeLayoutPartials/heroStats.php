<?php

use app\models\Gangster;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */

$user = Yii::$app->getUser();
?>

<div class="hero-stats" style="float: right">
    <table>
        <tbody>
        <tr>
            <td>
                <?= Html::a(Gangster::getGangsterProperty('username'), [
                    'user-management/profile',
                    'userId' => $user->getId()
                ]); ?>
            </td>
        </tr>
            <tr>
                <td>
                    <?php $gangsterImage = Yii::$app->runAction('image/get-image', [
                        'file'   => Gangster::getGangsterProperty('avatar'),
                        'width'  => 52,
                        'height' => 50
                    ]);

                    echo Html::a($gangsterImage, Url::to(['user-management/upload-avatar', 'userId' => $user->getId()]))
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>
