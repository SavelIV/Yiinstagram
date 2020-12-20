<?php

namespace frontend\controllers;

use frontend\models\Subscribe;
use Yii;
use yii\web\Controller;
use frontend\models\ContactForm;
use yii\web\Cookie;
use frontend\models\User;

/**
 * Site controller
 */
class SiteController extends Controller
{
    const FEED_POSTS_LIMIT = 7;
    const ACTIVE_USERS_LIMIT = 21;

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $users = User::find()->where(['status' => User::STATUS_ACTIVE])->limit(self::ACTIVE_USERS_LIMIT)->all();

        /* @var $currentUser User */
        if ($currentUser = Yii::$app->user->identity) {
            $feedItems = $currentUser->getFeed(self::FEED_POSTS_LIMIT);
        }

        $isSubscribed = Subscribe::isSubscribed();

        return $this->render('index', [
            'users' => $users,
            'feedItems' => $feedItems,
            'currentUser' => $currentUser,
            'isSubscribed' => $isSubscribed,
        ]);
    }

 /**
     * Displays Newsfeed page.
     *
     * @return mixed
     */
    public function actionNewsfeed()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/user/default/login']);
        }

        /* @var $currentUser User */
        if ($currentUser = Yii::$app->user->identity) {
            $limit = Yii::$app->params['feedPostLimit'];
            $feedItems = $currentUser->getFeed($limit);
        }

        return $this->render('newsfeed', [
            'feedItems' => $feedItems,
            'currentUser' => $currentUser,
        ]);
    }


    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', Yii::t('flash', 'Thank you for contacting us. We will respond to you as soon as possible.'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('flash', 'There was an error sending your message.'));
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Change language
     * @return mixed
     */
    public function actionLanguage()
    {
        $language = Yii::$app->request->post('language');
        Yii::$app->language = $language;

        $languageCookie = new Cookie([
            'name' => 'language',
            'value' => $language,
            'expire' => time() + 60 * 60 * 24 * 30, // 30 days
        ]);
        Yii::$app->response->cookies->add($languageCookie);
        return $this->redirect(Yii::$app->request->referrer);
    }

}
