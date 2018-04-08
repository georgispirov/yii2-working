<?php

namespace app\controllers;

use app\helpers\ImageContentGeneratorHelper;
use app\helpers\MalavitaFileHelper;
use MenaraSolutions\Geographer\Exceptions\FileNotFoundException;
use Yii;
use yii\helpers\Html;
use yii\web\Controller;

class ImageController extends Controller
{
    public function actionGetImage(string $file)
    {
        if (!MalavitaFileHelper::isFileExists($file)) {
            throw new FileNotFoundException('Image not found.');
        }

        $response = Yii::$app->getResponse();
        $response->headers->set('Content-Type', 'image/png');
        $contentData = ImageContentGeneratorHelper::getImageContent($file);
        echo Html::img('data:image/png;base64,' . base64_encode($contentData));
    }
}