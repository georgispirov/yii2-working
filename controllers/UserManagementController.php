<?php

namespace app\controllers;

use app\models\RegistrationForm;
use app\models\Users;
use Yii;
use yii\helpers\VarDumper;
use yii\web\Controller;

class UserManagementController extends Controller
{
    public $layout = 'userManagementLayout';

    public function actionLogin()
    {
        
    }

    public function actionRegistration()
    {
        $request = Yii::$app->getRequest();
        $model = new RegistrationForm();
        if ($model->load($request->post())) {
            $user = $model->registration();
            if ($user instanceof Users && Yii::$app->getUser()->login($user)) {
                return $this->goHome();
            }
        }

        return $this->render('registration', compact('model'));
    }

    public function actionLogout()
    {

    }

    public function actionStreaming()
    {
        return $this->render('streaming');
    }
}
