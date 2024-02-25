<?php

namespace backend\controllers;

use backend\models\User\LoginUserForm;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class LoginController extends Controller
{
    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }
    public $enableCsrfValidation = false;
    public function actionLogin()
    {
        $model = new LoginUserForm();
        return $model->login();
    }
}