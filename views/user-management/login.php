<?php

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LoginForm */
/* @var $form ActiveForm */

AppAsset::register($this);
$this->title = 'Login';
$this->params['breadcrumbs'] = $this->title;
?>
<div class="login col-xs-6">

    <?php $form = ActiveForm::begin([
            'method' => 'POST',
            'action' => Url::to(['user-management/login'])
    ]); ?>

        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, '_rememberMe')->checkbox() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
