<?php

/* @var $this yii\web\View */
/* @var $user \frontend\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['user/default/reset-password', 'token' => $user->password_reset_token]);
?>
<?php echo Yii::t('login', 'Hello '); ?> <?= $user->username ?>,

<?php echo Yii::t('login', 'Follow the link below to reset your password:'); ?>

<?= $resetLink ?>
