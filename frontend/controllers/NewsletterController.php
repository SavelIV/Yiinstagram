<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Subscribe;

class NewsletterController extends Controller
{
    public function actionSubscribe()
    {
        $model = new Subscribe();
        
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save()) {
                Yii::$app->session->setFlash('success', 'Subscribe for ' . $model->email . ' completed!');
            }
            else {
                Yii::$app->session->setFlash('error', 'This email: ' . $model->email. ' already exists!' );
            }
        }

        return $this->render('subscribe',[
            'model' => $model,
        ]);
    }
}
