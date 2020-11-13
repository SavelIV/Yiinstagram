<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View  */
/* @var $model frontend\models\Subscribe  */
/* @var $subscribers console\models\Subscriber  */


/*Заголовок страницы:*/
$this->title = 'Subscribe to newsletter';

/* Установка метатегов:*/
$this->registerMetaTag([
  'name' => 'description',
  'content' => 'Description of the page...'
]);


?>
<?php $form = ActiveForm::begin() ?>
<?= $form->field($model, 'email') ?>
<?= Html::submitButton('Send', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end() ?>



