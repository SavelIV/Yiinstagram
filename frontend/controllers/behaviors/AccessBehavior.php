<?php

namespace frontend\controllers\behaviors;

use yii\base\Behavior;
use Yii;
use yii\web\Controller;
/**
 * Description of AccessBehavior
 *
 * @author Igor
 */
class AccessBehavior extends Behavior
{
    public function events() {
        return [
            Controller::EVENT_BEFORE_ACTION => 'checkAccess'
        ];
    }

    public function checkAccess() {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'You should be logged / registered.');
            Yii::$app->controller->redirect(['site/index']);
            Yii::$app->end();
            
        }
    }

}
