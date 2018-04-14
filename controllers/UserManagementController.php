<?php

namespace app\controllers;

use app\models\forms\LoginForm;
use app\models\forms\RegistrationForm;
use app\models\forms\UpdateProfileForm;
use app\models\forms\UploadAvatarForm;
use app\models\Gangster;
use app\models\Users;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class UserManagementController extends Controller
{
    public $layout = 'userManagementLayout';

    public function actionLogin()
    {
        if (!Yii::$app->getUser()->getIsGuest()) {
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

    public function actionProfile(int $userId)
    {
        $request = Yii::$app->getRequest();
        $gangster = Gangster::findOne($userId);
        $updateForm = new UpdateProfileForm(['scenario' => UpdateProfileForm::UPDATE_PROFILE]);
        if ($updateForm->load($request->post(), $updateForm->formName()) && $updateForm->validate()) {
            if ($updateForm->update($gangster)) {
                Yii::$app->getSession()->setFlash('updated-profile', 'Успешна промяна на профила.');
                return $this->redirect(Yii::$app->getRequest()->getReferrer());
            }
        }

        return $this->render('profile', compact('gangster'));
    }

    public function actionUploadAvatar(int $userId)
    {
        $request = Yii::$app->getRequest();
        $gangster = Gangster::findOne($userId);
        $model = new UploadAvatarForm();
        if ($request->getIsPost()) {
            $model->image = UploadedFile::getInstance($model, 'image');

            if ($model->upload($gangster)) {
                Yii::$app->getSession()->setFlash('uploaded-avatar', 'Успешно промени аватара си.');
            }
        }

        return $this->render('uploadAvatar', compact('model'));
    }
}
