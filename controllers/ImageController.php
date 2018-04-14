<?php

namespace app\controllers;

use app\helpers\ImageContentGeneratorHelper;
use app\helpers\MalavitaFileHelper;
use MenaraSolutions\Geographer\Exceptions\FileNotFoundException;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Response;

class ImageController extends Controller
{
    public function actionGetImage(string $file, string $width, string $height)
    {
        if (!MalavitaFileHelper::isFileExists($file)) {
            throw new FileNotFoundException('Image not found.');
        }

        $response = Yii::$app->getResponse();
        $mimeType = FileHelper::getMimeTypeByExtension($file);
        $extension = pathinfo($file, PATHINFO_EXTENSION);

        $response->getHeaders()->set('Content-Type', $mimeType);
        $contentData = ImageContentGeneratorHelper::getImageContent($file);
        return Html::img('data:image/' . $extension .';base64,' . base64_encode($contentData),
                            compact('width', 'height'));
    }
}