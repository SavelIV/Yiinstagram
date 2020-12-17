<?php

namespace console\controllers;

use frontend\models\Parser;
use yii\console\Controller;
use console\models\News;
use console\models\Subscriber;
use console\models\Sender;
use Yii;

/**
 * @author Igor
 */
class MailerController extends Controller
{
    /**
     * Sends newsletters by Cron:
     * %progdir%\modules\php\%phpdriver%\php-win.exe -c %progdir%\modules\php\%phpdriver%\php.ini -q -f %sitedir%\yii\yii mailer/send
     * it's openserver settings on localhost
     */
    public function actionSend()
    {
        $updated = Parser::parseList();
        sleep(10);
        $newsCount = "\n Обновлено новостей: {$updated}";
        $emailsCount = "\n Писем отправлено (подписчики): 0";
        $statusesCount = "\n Изменено статусов в БД: 0";
        $subscribers = [];
        $noNews = "";
        $noSubscribers = "";

        $maxNews = Yii::$app->params['maxNewsInList'];
        $newsList = News::getList($maxNews);

        if ($newsList != 0) {
            $subscribers = Subscriber::getList();

            if (!empty($subscribers) && is_array($subscribers)) {

                if ($count = Sender::run($subscribers, $newsList)) {
                    $statuses = News::changeStatus($newsList);
                };

                $emailsCount = "\n Писем отправлено (подписчики): {$count}";
                $statusesCount = "\n Изменено статусов в БД: {$statuses}";
            } else {
                $noSubscribers = "\n Нет подписчиков";
            }
        } else {
            $noNews = "\n Нет свежих новостей";
        }

        Sender::runAdmin($newsCount, $emailsCount, $statusesCount, $subscribers, $noNews, $noSubscribers);
    }
}
