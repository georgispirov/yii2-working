<?php

namespace app\helpers;

use yii\helpers\FileHelper;

class MalavitaFileHelper extends FileHelper
{
    public static function isFileExists(string $file)
    {
        return file_exists($file);
    }
}