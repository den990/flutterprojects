<?php

namespace backend\controllers;


use yii\web\Controller;
use Yii;
use yii\web\Response;
use yii\db;
use common\models\User;
use backend\models\User\RegisterUserForm;

class RegisterController extends Controller
{
    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        return parent::beforeAction($action);
    }

    public $enableCsrfValidation = false;
    public function actionRegistration()
    {
        $model = new RegisterUserForm();
        return $model->registration();
    }
}