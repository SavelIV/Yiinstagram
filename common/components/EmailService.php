<?php


namespace common\components;
use Yii;
use yii\base\Component;
use common\components\UserNotificationInterface;

/**
 * Description of EmailService
 *
 * @author Igor
 */
class EmailService extends Component {
    
    /**
     * @param UserNotificationInterface $event
     * @param string $subject
     * @return bool
     */
    public function notifyUser(UserNotificationInterface $event)
    {
        return Yii::$app->mailer->compose()
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' admin'])
                ->setTo($event->getEmail())
                ->setSubject($event->getSubject())
                ->setHtmlBody('<b>Добро пожаловать на сайт '. Yii::$app->name.'</b>')
                ->send();
    }
   /**
    * @param UserNotificationInterface $event
    * @return bool
    */
    public function notifyAdmins(UserNotificationInterface $event)
    {
        return Yii::$app->mailer->compose()
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                ->setTo('saviv@saviv.site')
                ->setSubject($event->getSubject())
                ->setHtmlBody('<b>Зарегистрирован новый пользователь на сайте ' . Yii::$app->name .'</b>'
                        .'<hr>Username: ' . $event->getUsername() 
                        .'<hr>Email: ' . $event->getEmail())
                ->send();
    }
   
}
