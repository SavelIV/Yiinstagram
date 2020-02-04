<?php

namespace frontend\modules\user\components;

use Yii;
use frontend\modules\user\models\Auth;
use frontend\models\User;
use yii\authclient\ClientInterface;
use yii\helpers\ArrayHelper;

/**
 * AuthHandler handles successful authentication via Yii auth component
 */
class AuthHandler {

    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client) {
        $this->client = $client;
    }

    public function handle() {
        if (!Yii::$app->user->isGuest) {
            return;
        }
        $attributes = $this->client->getUserAttributes();
        $auth = $this->findAuth($attributes);

        if ($auth) {
            /* @var User $user */
            $user = $auth->user;
            return Yii::$app->user->login($user);
        }
        if ($user = $this->createAccount($attributes)) {
            return Yii::$app->user->login($user);
        }
    }

    /**
     * @param array $attributes
     * @return Auth
     */
    private function findAuth($attributes) {
        $id = ArrayHelper::getValue($attributes, 'id');
        $params = [
            'source_id' => $id,
            'source' => $this->client->getId(),
        ];

        return Auth::find()->where($params)->one();
    }

    /**
     * 
     * @param type $attributes
     * @return User|null
     */
    private function createAccount($attributes) {
        $email = ArrayHelper::getValue($attributes, 'email');
        $id = ArrayHelper::getValue($attributes, 'id');
        $name = ArrayHelper::getValue($attributes, 'name');

//        echo '<pre>';
//        print_r($attributes);
//        echo '</pre>'; 
//        echo '<pre>';
//        print_r($email);
//        echo '</pre>';
//        echo '<pre>';
//        print_r($id);
//        echo '</pre>';
//        echo '<pre>';
//        print_r($name);
//        echo '</pre>';
//        die;
//        

        if ($email !== null && User::find()->where(['email' => $email])->exists()) {
            Yii::$app->getSession()->setFlash('error', [
                Yii::t('app', "User with the same email as in {client} account already exists "
                        . "but isn't linked to it. Login using email first to link it.", ['client' => $this->client->getTitle()]),
            ]);
            return;
        }

        $user = $this->createUser($email, $name);

        $transaction = User::getDb()->beginTransaction();
        if ($user->save()) {
            $auth = $this->createAuth($user->id, $id);
            if ($auth->save()) {
                $transaction->commit();
                return $user;
            }
        }
        Yii::$app->getSession()->setFlash('error', [
            Yii::t('app', 'Unable to save {client} account: {errors}', [
                'client' => $this->client->getTitle(),
                'errors' => json_encode($user->getErrors()),
            ]),
        ]);
        $transaction->rollBack();
    }

    private function createUser($email, $name) {
        return new User([
            'username' => $name,
            'email' => $email,
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash(Yii::$app->security->generateRandomString()),
            'created_at' => $time = time(),
            'updated_at' => $time,
        ]);
    }

    private function createAuth($userId, $sourceId) {
        return new Auth([
            'user_id' => $userId,
            'source' => $this->client->getId(),
            'source_id' => (string) $sourceId,
        ]);
    }

}
