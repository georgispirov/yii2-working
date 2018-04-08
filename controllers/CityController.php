<?php

namespace app\controllers;

use app\models\City;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Response;

class CityController extends Controller
{
    public function actionGetCity()
    {
        Yii::$app->getResponse()->format = Response::FORMAT_JSON;
        $request   = Yii::$app->getRequest();
        $countryID = ArrayHelper::getValue($request->post(), 'depdrop_all_params.country-id');
        $cities = [];

        if (null !== $countryID) {
            $cities = City::find()->select(['id', 'name'])->where(['country_id' => $countryID])->asArray()->all();
        }

        echo Json::encode(['output' => $cities, 'selected' => '']);
    }
}