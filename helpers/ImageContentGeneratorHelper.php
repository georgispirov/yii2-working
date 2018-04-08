<?php

namespace app\helpers;

use yii\base\BaseObject;

class ImageContentGeneratorHelper extends BaseObject
{
    public static function getImageContent(string $file): string
    {
        ob_start();
        imagepng(imagecreatefrompng($file));
        $contentData = ob_get_contents();
        ob_end_clean();
        return $contentData;
    }
}