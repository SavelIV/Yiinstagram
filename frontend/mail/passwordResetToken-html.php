<?php
use yii\helpers\Html;
use frontend\models\User;

/* @var $this yii\web\View */
/* @var $user frontend\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['user/default/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p><?php echo Yii::t('login', 'Hello '); ?> <?= Html::encode($user->username) ?>,</p>

    <p><?php echo Yii::t('login', 'Follow the link below to reset your password:'); ?></p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
