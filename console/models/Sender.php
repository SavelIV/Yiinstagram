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
            ])
                    ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['senderName']])
                    ->setTo($subscriber['email'])
                    ->setSubject('Последние новости с сайта yii2site.com')
                    ->send();


            if ($result) {
                $count++;
            }
        }
        return $count;
    }

}
