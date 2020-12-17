<?php

namespace frontend\controllers;
use frontend\models\SearchForm;
use Yii;

class SearchController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new SearchForm();
        
        $results = null;
        
        if ($model->load(Yii::$app->request->post())) {
             $results = $model->search();
        }
        return $this->render('index',[
            'model' => $model,
            'results' => $results,
        ]);
    }
    
//    public function actionAdvanced()
//    {
//        $model = new SearchForm();
//
//        $results = null;
//
//        if ($model->load(Yii::$app->request->post())) {
//             $results = $model->searchAdvanced();
//        }
//        return $this->render('advanced',[
//            'model' => $model,
//            'results' => $results,
//        ]);
//    }

}
