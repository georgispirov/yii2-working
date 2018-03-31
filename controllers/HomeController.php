<?php

namespace app\controllers;

use yii\web\Controller;

class HomeController extends Controller
{
    public $layout = 'homeLayout';

    public function actionIndex()
    {
        return $this->render('index');
    }
}
