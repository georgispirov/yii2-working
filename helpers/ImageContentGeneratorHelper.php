<?php

namespace app\helpers;

use yii\base\BaseObject;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;

class ImageContentGeneratorHelper extends BaseObject
{
    public static function getImageContent(string $file): string
    {
        $method = ArrayHelper::getValue(self::callFunctionBasedOnMimeType($file), 'method');
        $helperMethod = ArrayHelper::getValue(self::callFunctionBasedOnMimeType($file), 'helperMethod');

        ob_start();
        $method($helperMethod($file));
        $contentData = ob_get_contents();
        ob_end_clean();
        return $contentData;
    }

    private static function callFunctionBasedOnMimeType(string $file): array
    {
        $method = null;
        $helperMethod = null;

        switch (FileHelper::getMimeTypeByExtension($file)) {
            case 'image/jpg':
                $method = 'imagejpeg';
                $helperMethod = 'imagecreatefromjpeg';
                break;
            case 'image/jpeg':
                $method = 'imagejpeg';
                $helperMethod = 'imagecreatefromjpeg';
                break;
            case 'image/png':
                $method = 'imagepng';
                $helperMethod = 'imagecreatefrompng';
                break;
            case 'image/gif':
                $method = 'imagegif';
                $helperMethod = 'imagecreatefromgif';
                break;
            default:
                break;
        }

        return compact('method', 'helperMethod');
    }
}