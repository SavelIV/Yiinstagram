<?php

namespace frontend\controllers;

use console\models\Sender;
use console\models\Subscriber;
use Faker\Factory;
use Yii;
use yii\web\Controller;
use frontend\models\Subscribe;
use frontend\models\Test;
use frontend\models\News;

class TestController extends Controller
{

//    public function actionGenerate()
//    {
//
//
//        /* faker-generator for table news*/
//        $faker = Factory::create();
//        for ($j = 0; $j < 100; $j++) {
//
//            $news = [];
//            for ($i = 0; $i < 1000; $i++) {
//                $news[] = [$faker->text(rand(20, 35)), $faker->text(rand(1000, 1500)), rand(0, 1)];
//            }
//
//            Yii::$app->db->createCommand()->batchInsert('news', ['title', 'content', 'status'], $news)->execute();
//            unset($news);
//        }
//    }


}


