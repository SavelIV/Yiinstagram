<?php

namespace frontend\controllers;
use Faker\Factory;
use Yii;
use yii\web\Controller;
use frontend\models\Test;
use frontend\models\News;

class TestController extends Controller
 {

    public function actionGenerate() {


        /* faker-generator */
        $faker = Factory::create();
        for ($j = 0; $j < 100; $j++) {

            $news = [];
            for ($i = 0; $i < 1000; $i++) {
                $news[] = [$faker->text(rand(30, 45)), $faker->text(rand(2000, 3000)), rand(0, 1)];
            }

            Yii::$app->db->createCommand()->batchInsert('news', ['title', 'content', 'status'], $news)->execute();
            unset($news);
        }
    }

    //
    public function actionIndex()
    {
      $max = Yii::$app->params['maxNewsInList'];  
      
      $list = Test::getNewsList($max);
      
      return $this->render('index',[
          'list' => $list, 
              ]); 
        
    }
    
    //
    public function actionView($id)
    {
      $item = Test::getNewsItemById($id);
      
      return $this->render('view',[
          'item' => $item, 
              ]); 
        
    }
    //Mail sender:  yii2frontend.com/test/mail
    
//    public function actionMail ()
//    {
//        $result = Yii::$app->mailer->compose()
//                ->setFrom('savelevi55@gmail.com')
//                ->setTo('savelevi@mail.ru')
//                ->setSubject('Тема сообщения: отправка почты с сайта yii2frontend.com')
//                ->setTextBody('Заголовок сообщения?')
//                ->setHtmlBody('<b>текст сообщения в формате HTML: записан в тегах</b>')
//                ->send();
//        
//        var_dump($result);die; // return: bool(true)
//    }
}


