<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View  */
/* @var $model frontend\models\Subscribe  */
/* @var $subscribers console\models\Subscriber  */

$this->title = Html::encode(Yii::t('flash', 'Subscribe to newsletter'));

?>
<h3><?php echo Yii::t('flash', 'Daily Email Update'); ?></h3>
<p><?php echo Yii::t('flash', 'Subscribe below and we`ll send you a daily email summary of all the spam
    that you`ll be able to handle!'); ?>
</p>
<?php $form = ActiveForm::begin() ?>
<?= $form->field($model, 'email') ?>
<?= Html::submitButton(Yii::t('flash', 'Subscribe'), ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end() ?>



