<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Book;
use frontend\models\Publisher;
use frontend\controllers\behaviors\AccessBehavior;

class BookshopController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            AccessBehavior::className(),            
        ];
    }
    public function actionIndex()
    {
//        $condition = (['publisher_id' => 1]);
        $bookList = Book::find()->orderBy('id')->limit(30)->all();

        return $this->render('index', [
            'bookList' => $bookList,
        ]);
    }
    
    public function actionCreate()
    {
        $book = new Book();
        $publishers = Publisher::getList();
        
        if ($book->load(Yii::$app->request->post()) && $book->save()){
        Yii::$app->session->setFlash('success', 'Saved!'); 
        return $this->refresh();
        }
        
        return $this->render('create', [
            'book' => $book,
            'publishers' => $publishers,
        ]);
    }

}
