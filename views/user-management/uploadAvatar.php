<?php

use app\assets\HomeAsset;
use app\models\forms\UploadAvatarForm;
use kartik\growl\Growl;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model UploadAvatarForm */

HomeAsset::register($this);

$this->title = 'Качи Аватар';
$this->params['breadcrumbs'] = $this->title;

$session = Yii::$app->getSession();

if ($session->hasFlash('uploaded-avatar')) {
    echo Growl::widget([
        'type'          => Growl::TYPE_SUCCESS,
        'icon'          => 'glyphicon glyphicon-ok-sign',
        'showSeparator' => true,
        'body'          => $session->getFlash('uploaded-avatar'),
        'pluginOptions' => [
            'placement' => [
                'from'  => 'center',
                'align' => 'center',
            ]
        ]
    ]);
}

$form = ActiveForm::begin(['options' => [
        'enctype' => 'multipart/form-data',
    ],
    'action' => Url::to(['user-management/upload-avatar/', 'userId' => Yii::$app->getUser()->getId()]),
    'method' => 'POST'
]); ?>

<?= $form->field($model, 'image')->fileInput() ?>

    <button>Submit</button>

<?php ActiveForm::end(); ?>