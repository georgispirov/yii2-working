<?php

namespace app\models\forms;

use app\models\Gangster;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadAvatarForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $image;

    /**
     * @return array
     */
    public function rules()
    {
        return [
           [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, gif, bmp']
        ];
    }

    /**
     * @param Gangster $gangster
     * @return bool
     */
    public function upload(Gangster $gangster)
    {
        if (!$this->validate()) {
            return false;
        }

        $path = Yii::$app->getBasePath() . '/images/'
                                         . $gangster->getUsername() . '_avatar'
                                         . '.' . $this->image->getExtension();

        $this->image->saveAs($path);
        $gangster->setAttribute('avatar', $path);

        return $gangster->save();
    }
}