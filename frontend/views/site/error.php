<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">
    <h1><?= Html::encode(Yii::t('flash', 'Not found (#404)'))?></h1>
    <div class="alert alert-danger fade in">
        <?php echo Yii::t('flash', 'The above error occurred while the Web server was processing your request.'); ?>
        <?= nl2br(Html::encode($message)) ?>
    </div>
</div>
