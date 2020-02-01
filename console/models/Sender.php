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
            $result = Yii::$app->mailer->compose('/mailer/newslist',[
                'newsList' => $newsList
            ])
                    ->setFrom('savelevi55@gmail.com')
                    ->setTo($subscriber['email'])
                    ->setSubject('Тема сообщения: отправка почты с сайта yii2frontend.com')
                    ->send();

            if ($result) {
                $count++;
            }
        }
        return $count;
    }

}
