<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\RegistrationForm;
use app\models\Users;
use Yii;
use yii\web\Controller;

class UserManagementController extends Controller
{
    public $layout = 'userManagementLayout';

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
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
        if (Yii::$app->getUser()->logout()) {
            return $this->goHome();
        }
        return $this->redirect(Yii::$app->getRequest()->getReferrer());
    }
}
