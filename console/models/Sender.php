<?php


namespace console\models;

use Yii;

/**
 * @author Igor
 */
class Sender 
{
    /**
     * Send emails with news content to subscribers 
     * @param array $subscribers
     * @param array $newsList
     */
    public static function run($subscribers, $newsList) {
        
        $count = 0;

        foreach ($subscribers as $subscriber) {

            $result = Yii::$app->mailer->compose('/mailer/newslist', [
                'newsList' => $newsList,
                'subscriber' => $subscriber,
            ])
                    ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['senderName']])
                    ->setTo($subscriber['email'])
                    ->setSubject('Последние новости с сайта '. Yii::$app->name)
                    ->send();


            if ($result) {
                $count++;
                sleep(3);
            }
        }
        return $count;
    }


    public static function runAdmin($newsCount,$emailsCount,$statusesCount,$subscribers,$noNews,$noSubscribers) {


            Yii::$app->mailer->compose('/mailer/adminlist', [
                'newsCount' => $newsCount,
                'emailsCount' => $emailsCount,
                'statusesCount' => $statusesCount,
                'subscribers' => $subscribers,
                'noNews' => $noNews,
                'noSubscribers' => $noSubscribers,
            ])
                    ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['senderName']])
                    ->setTo(Yii::$app->params['adminEmail'])
                    ->setSubject('Информация о рассылке с сайта '. Yii::$app->name)
                    ->send();

    }

}
