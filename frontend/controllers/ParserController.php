<?php


namespace frontend\controllers;

use frontend\models\Parser;
use yii\web\Controller;
use Yii;

class ParserController extends Controller
{
    public function actionParse()
    {
        return $this->render('parse');
    }

    public function actionView($id)
    {
        $item = Parser::getNewsItemById($id);

        return $this->render('view', [
            'item' => $item,
        ]);

    }

    public function actionUpdate()
    {
        $count = Parser::parseList();

//        Yii::$app->session->setFlash('success', 'Success! Latest '. $count .' news were added or updated.');
        return $this->redirect(['/']);

    }

}