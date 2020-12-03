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
//        /* faker-generator */
//        $faker = Factory::create();
//        for ($j = 0; $j < 100; $j++) {
//
//            $news = [];
//            for ($i = 0; $i < 1000; $i++) {
//                $news[] = [$faker->text(rand(20, 35)), $faker->text(rand(1000, 1500)), rand(1, 3)];
//            }
//
//            Yii::$app->db->createCommand()->batchInsert('news', ['title', 'content', 'status'], $news)->execute();
//            unset($news);
//        }
//    }

    //
    public function actionIndex()
    {
        $max = Yii::$app->params['maxNewsInList'];

        $list = Test::getNewsList($max);

        return $this->render('index', [
            'list' => $list,
        ]);

    }
    public function actionM()
    {
        $max = Yii::$app->params['maxNewsInList'];

        $newsList = Test::getNewsList($max);

        return $this->render('newslist', [
            'newsList' => $newsList,
        ]);

    }

    //
    public function actionView($id)
    {
        $item = Test::getNewsItemById($id);

        return $this->render('view', [
            'item' => $item,
        ]);

    }
    //Mail sender:  yii2site.com/test/mail

    public function actionMail()
    {
        $maxNews = Yii::$app->params['maxNewsInList'];
        $newsList = \console\models\News::getList($maxNews);
        $model = new Subscribe();
        $subscribers = Subscriber::getList();

        $count = Sender::run($subscribers,$newsList);

        return $this->render('/test/subscribe',[
            'model' => $model,
            'subscribers' => $subscribers,
            'count' => $count
        ]);
    }
}


