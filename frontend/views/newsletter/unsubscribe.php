<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View  */
/* @var $model frontend\models\Subscribe  */
/* @var $subscribers console\models\Subscriber  */

$this->title = Html::encode(Yii::t('flash', 'Unsubscribe from newsletters'));

?>
<h3><?php echo Yii::t('flash', 'You have been unsubscribed from our Daily Email Update'); ?></h3>
<p><?php echo Yii::t('flash', 'Thanks for being with us.'); ?>
</p>
<a href="<?php echo Url::to(['/site/index']); ?>">
    <img src="/img/logo.png" alt="">
</a>




