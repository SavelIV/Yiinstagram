<?php

namespace frontend\modules\user\models;

use Yii;
use yii\base\Model;
use frontend\models\User;
use frontend\models\events\UserRegisteredEvent;

/**
 * Signup form
 */
class SignupForm extends Model {

    public $username;
    public $email;
    public $password;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => User::className(), 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User $user
     */
    public function signup() {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        if ($user->save()) {
            $event = new UserRegisteredEvent();
            $event->user = $user;
            $event->subject = 'New user registered';

            $user->trigger(User::USER_REGISTERED, $event);

            return $user;
        }
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
//    protected function sendEmail($user)
//    {
//        return Yii::$app
//            ->mailer
//            ->compose(
//                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
//                ['user' => $user]
//            )
//            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
//            ->setTo($this->email)
//            ->setSubject('Account registration at ' . Yii::$app->name)
//            ->send();
//    }
}
