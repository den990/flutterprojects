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
            [['username','password'], 'required'],
            [['email'], 'email'],
        ];
    }

    public function init()
    {
        $this->load(Yii::$app->request->post(), '');
    }

    public function registration()
    {
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->status = 10;
        if ($user->save()) {
                return ['message' => 'Пользователь зарегестрирован'];
        }
        else
        {
            return ['message' => 'Произошла ошибка при сохранении пользователя'];
        }
    }
}