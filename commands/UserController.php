<?php

namespace app\commands;

use yii\base\Model;
use yii\console\Controller;
use yii\console\Exception;
use yii\helpers\Console;
use app\modules\admin\models\User;

/**
 * UserController реализует консольные команды для работы с пользователем.
 */
class UserController extends Controller
{
    /**
     * Инициализация команд.
     */
    public function actionIndex()
    {
        echo 'yii user/create-default-user' . PHP_EOL;
        echo 'yii user/create' . PHP_EOL;
        echo 'yii user/remove' . PHP_EOL;
        echo 'yii user/change-password' . PHP_EOL;
    }

    /**
     * Команда создания пользователя (администратора) по умолчанию.
     */
    public function actionCreateDefaultUser()
    {
        $model = new User();
        $model->username = 'admin';
        $model->setPassword('admin');
        $model->generateAuthKey();
        $model->full_name_ru = 'Александр Николайчук';
        $model->full_name_en = 'Alexander Nikolaychuk';
        $model->address_ru = 'ru';
        $model->address_en = 'en';
        $model->email = 'tristruny@gmail.com';
        $model->phone = '+7 919 109 74 94';
        $model->youtube_link = 'https://www.youtube.com/channel/UC3x90VDBUlGhUG9xh5yJoaw';
        $model->instagram_link = 'https://www.instagram.com/nikolaychuk_alexander/';
        $model->vk_link = 'https://vk.com/nikolaychuk1993';
        $this->log($model->save());
    }

    /**
     * Команда создания пользователя (администратора).
     */
    public function actionCreate()
    {
        $model = new User();
        $this->readValue($model, 'username');
        $this->readValue($model, 'email');
        $model->setPassword($this->prompt('Password:', [
            'required' => true,
            'pattern' => '#^.{5,255}$#i',
            'error' => 'More than 5 symbols',
        ]));
        $model->generateAuthKey();
        $this->log($model->save());
    }

    /**
     * Команда удаления пользователя.
     */
    public function actionRemove()
    {
        $username = $this->prompt('Username:', ['required' => true]);
        $model = $this->findModel($username);
        $this->log($model->delete());
    }

    /**
     * Команда смены пароля пользователю.
     */
    public function actionChangePassword()
    {
        $username = $this->prompt('Username:', ['required' => true]);
        $model = $this->findModel($username);
        $model->setPassword($this->prompt('New password:', [
            'required' => true,
            'pattern' => '#^.{5,255}$#i',
            'error' => 'More than 5 symbols',
        ]));
        $this->log($model->save());
    }

    /**
     * Поиск пользователя по имени.
     * @param string $username
     * @throws \yii\console\Exception
     * @return User the loaded model
     */
    private function findModel($username)
    {
        if (!$model = User::findOne(['username' => $username])) {
            throw new Exception('User not found');
        }
        return $model;
    }

    /**
     * Чтение введенных пользователем значений (атрибутов команды) через командную строку.
     * @param Model $model
     * @param string $attribute
     */
    private function readValue($model, $attribute)
    {
        $model->$attribute = $this->prompt(mb_convert_case($attribute, MB_CASE_TITLE, 'utf-8') . ':', [
            'validator' => function ($input, &$error) use ($model, $attribute) {
                $model->$attribute = $input;
                if ($model->validate([$attribute])) {
                    return true;
                } else {
                    $error = implode(',', $model->getErrors($attribute));
                    return false;
                }
            },
        ]);
    }

    /**
     * Вывод сообщений на экран (консоль)
     * @param bool $success
     */
    private function log($success)
    {
        if ($success) {
            $this->stdout('Success!', Console::FG_GREEN, Console::BOLD);
        } else {
            $this->stderr('Error!', Console::FG_RED, Console::BOLD);
        }
        echo PHP_EOL;
    }
}