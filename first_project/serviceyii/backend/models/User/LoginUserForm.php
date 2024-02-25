<?php

namespace backend\models\User;

use common\models\User;
use yii\base\Model;
use Yii;

class LoginUserForm extends Model
{
    public $username;
    public $password;

    public function rules()
    {
        return [
            [['password', 'username'], 'required'],
        ];
    }

    public function init()
    {
        $request = YII::$app->request;
        $data = json_decode($request->getRawBody(), true);

        $this->username = $data['username'];
        $this->password = $data['password'];

    }
    public function login()
    {
        if ($this->username && $this->password)
        {
            $user = User::findOne(['username' => $this->username]);
            if ($user)
            {
                if (Yii::$app->security->validatePassword($this->password, $user->password_hash))
                {
                    return ['message' => 'Вы успешно авторизовались',
                            'isLogin' => true];
                }
                else
                {
                    return ['message' => 'Невалидный email или пароль',
                        'isLogin' => false];
                }
            }
            else
            {
                return ['message' => 'Невалидный email или пароль',
                    'isLogin' => false];
            }
        }
        else
        {
            return ['message' => 'Заполните все данные',
                'isLogin' => false];
        }
    }

}