<?php

namespace backend\controllers;

use common\models\User;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class UserController extends Controller
{
    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }
    public $enableCsrfValidation = false;
    public function actionGetInfo()
    {
        $request = YII::$app->request;
        $data = json_decode($request->getRawBody(), true);
        $accessToken = $data['accessToken'];
        if ($accessToken)
        {
            $user = User::findOne(['verification_token' => $accessToken]);
            if ($user)
            {
                return [
                    'username' => $user->username,
                    'email' => $user->email,
                    'success' => true,
                ];
            }
            else
            {
                return ['message' => 'Ошибка, нет пользователя с таким токеном', 'success' => false];
            }
        }
        else
        {
            return ['message' => 'Ошибка, токен пустой', 'success' => false];
        }
    }
}