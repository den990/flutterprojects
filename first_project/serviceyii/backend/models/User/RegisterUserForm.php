<?php
namespace backend\models\User;

use common\models\User;
use Yii;
use yii\base\Model;

class RegisterUserForm extends Model
{
    public $email;
    public $username;
    public $password;


    public function rules()
    {
        return [
            [['username','password', 'email'], 'required'],
            [['email'], 'email'],
        ];
    }

    public function init()
    {
        $request = YII::$app->request;
        $data = json_decode($request->getRawBody(), true);

        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->email = $data['email'];
    }

    public function registration()
    {
        if ($this->password && $this->username && $this->email)
        {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->status = 10;
            if ($user->save())
            {
                return ['message' => 'Пользователь зарегестрирован'];
            } else
            {
                return ['message' => 'Произошла ошибка при сохранении пользователя', 'errors' => $user->errors];
            }
        }
        else
        {
            return ['message' => 'Заполните все данные'];
        }
    }
}