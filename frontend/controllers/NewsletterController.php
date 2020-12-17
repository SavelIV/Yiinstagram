<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Html;
use yii\web\Controller;
use frontend\models\Subscribe;

class NewsletterController extends Controller
{

    /**
     * Subscribes user on daily emails (adds user email in "Subscribers" table.
     */
    public function actionSubscribe()
    {
        $model = new Subscribe();
        
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('flash', 'Subscribe for {email} completed!',
                    [
                        'email' => Html::encode($model->email),
                    ])
                );
            }
            else {
                Yii::$app->session->setFlash('error', Yii::t('flash', 'This email: {email} already exists!',
                    [
                        'email' => Html::encode($model->email),
                    ])
                );
            }

            return $this->goHome();
        }

        return $this->render('subscribe',[
            'model' => $model,
        ]);
    }

    /**
     * Unsubscribes user from emails (delete user email from "Subscribers" table.
     * @param int $id
     */
    public function actionUnsubscribe($id)
    {
        $id = intval($id);
        $model = new Subscribe();
        $model->delete($id);

        return $this->render('unsubscribe');
    }
}
