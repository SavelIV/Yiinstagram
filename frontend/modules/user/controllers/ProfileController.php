<?php

namespace frontend\modules\user\controllers;

use Faker\Factory;
use frontend\controllers\behaviors\AccessBehavior;
use frontend\modules\user\models\forms\PictureForm;
use yii\web\Controller;
use yii\web\UploadedFile;
use frontend\models\User;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use Yii;

/**
 * Profile controller for the user page
 */
class ProfileController extends Controller {

    public function behaviors()
    {
        return [
            AccessBehavior::class,
        ];
    }

    public function actionView($nickname) {

        /* @var $currentUser User */
        $currentUser = Yii::$app->user->identity;

        $modelPicture = new PictureForm();

        return $this->render ('view', [
            'user' => $this->findUser($nickname),
            'currentUser' => $currentUser,
            'modelPicture' => $modelPicture
        ]);
    }

    /**
     * Updates an existing User profile.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateProfile($id)
    {

        $model = $this->findUser($id);

         if ($model->load(Yii::$app->request->post()) && $model->save()) {
             Yii::$app->session->setFlash('success', 'Your profile has been updated');
             return $this->redirect(['view', 'nickname' => $model->nickname]);
         }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Handle profile image upload via ajax request
     */
    public function actionUploadPicture()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new PictureForm();
        $model->picture = UploadedFile::getInstance($model, 'picture');

        if ($model->validate()) {

            $user = Yii::$app->user->identity;
            $user->picture = Yii::$app->storage->saveUploadedFile($model->picture);

            if ($user->save(false, ['picture'])) {
                return [
                    'success' => true,
                    'pictureUri' => Yii::$app->storage->getFile($user->picture),
                ];
            }
        }
        return ['success' => false, 'errors' => $model->getErrors()];
    }

    public function actionDeletePicture()
    {
        /* @var $currentUser User */
        $currentUser = Yii::$app->user->identity;

        if ($currentUser->deletePicture()) {
            Yii::$app->session->setFlash('success', Yii::t('flash', 'Picture deleted.'));
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('flash', 'Error occurred.'));
        }

        return $this->redirect(['/user/profile/view', 'nickname' => $currentUser->getNickname()]);
    }


    /**
     * @param string $nickname
     * @return User
     * @throws NotFoundHttpException
     */
    private function findUser($nickname)
    {
        if ($user = User::find()->where(['nickname' => $nickname, 'status' => User::STATUS_ACTIVE])->orWhere(['id' => $nickname, 'status' => User::STATUS_ACTIVE])->one()) {
            return $user;
        }
        throw new NotFoundHttpException();
    }

    public function actionSubscribe($id)
    {
        /* @var $currentUser User */
        $currentUser = Yii::$app->user->identity;
        $user = $this->findUserById($id);

        $currentUser->followUser($user);

        Yii::$app->session->setFlash('success',  $currentUser->username .' is '. $user->username .'`s follower now.');
        return $this->redirect(['/user/profile/view', 'nickname' => $user->getNickname()]);

    }


    /**
     * @param integer $id
     */
    public function actionUnsubscribe($id)
    {
        /* @var $currentUser User */
        $currentUser = Yii::$app->user->identity;
        $user = $this->findUserById($id);

        $currentUser->unfollowUser($user);

        Yii::$app->session->setFlash('error',  $currentUser->username .' is not '. $user->username .' follower anymore.');
        return $this->redirect(['/user/profile/view', 'nickname' => $user->getNickname()]);

    }

    /**
     * @param integer $id
     * @return User
     * @throws NotFoundHttpException
     */
    private function findUserById($id)
    {
        if ($user = User::findOne($id)) {
            return $user;
        }
        throw new NotFoundHttpException();
    }

//    public function actionGenerate()
//    {
//        /* faker-generator */
//        $faker = Factory::create();
//
//            for ($i = 0; $i < 1000; $i++) {
//                $user = new User([
//                    'username' => $faker->name,
//                    'email' => $faker->email,
//                    'about' => $faker->text(200),
//                    'nickname' => $faker->regexify('[A-Za-z0-9_]{5,15}'),
//                    'auth_key' => Yii::$app->security->generateRandomString(),
//                    'password_hash' => Yii::$app->security->generateRandomString(),
//                    'created_at' => $time = time(),
//                    'updated_at' => $time,
//                ]);
//                $user->save(false);
//            }
//    }

}
