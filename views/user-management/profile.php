<?php

use app\assets\HomeAsset;
use app\models\Gangster;
use kartik\growl\Growl;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $gangster Gangster */

HomeAsset::register($this);
$session = Yii::$app->getSession();

if ($session->hasFlash('updated-profile')) {
    echo Growl::widget([
        'type'          => Growl::TYPE_SUCCESS,
        'icon'          => 'glyphicon glyphicon-ok-sign',
        'showSeparator' => true,
        'body'          => $session->getFlash('updated-profile'),
        'pluginOptions' => [
            'placement' => [
                'from'  => 'center',
                'align' => 'center',
            ]
        ]
    ]);
}
?>

<div class="update-profile col-xs-6">
    <?php
    $this->title = 'Profile';
    $this->params['breadcrumbs'] = $this->title;

    $form = ActiveForm::begin([
        'action' => Url::to(['user-management/profile', 'userId' => $gangster->getId()]),
        'method' => 'POST'
    ]);

    echo $form->field($gangster, 'username');
    echo $form->field($gangster, 'email');
    echo $form->field($gangster, 'first_name');
    echo $form->field($gangster, 'last_name'); ?>

    <div class="form-group">
        <?= Html::submitButton('Промяна', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>