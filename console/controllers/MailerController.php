<?php

namespace console\controllers;

use yii\helpers\Console;
use console\models\News;
use console\models\Subscriber;
use console\models\Sender;
use Yii;

/**
 * @author Igor
 */
class MailerController extends \yii\console\Controller
{
    /**
     * Sends newsletters
     */
    public function actionSend()
    {
        $maxNews = Yii::$app->params['maxNewsInList'];
        $newsList = News::getList($maxNews);
        $subscribers = Subscriber::getList();

        $count = Sender::run($subscribers,$newsList);

        Console::output("\nEmails sent: {$count}");
    }
}
