<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View  */
/* @var $model frontend\models\Subscribe  */
/* @var $subscribers console\models\Subscriber  */
/* @var $count frontend\controllers\NewsletterController  */


/*Заголовок страницы:*/
$this->title = 'Подпишитесь на новости!';

/* Установка метатегов:*/
$this->registerMetaTag([
  'name' => 'description',
  'content' => 'Description of the page...'
]);

/* Установка breadcrumbs:*/
$this->params['breadcrumbs'] = [
  'Test 1',
  'Test 2',
  ['label' => 'Test 3', 'url' => ['/site/index']],
  'Test 4',
];
echo 'Email отправлены '. $count .' адресатам: ';
foreach ($subscribers as $subscriber) {
    echo '<br>' . ($subscriber['email']);
}
echo '<tr>';


//if ($model->hasErrors()) {
//    echo '<pre>';
//    print_r($model->getErrors());
//    echo '</pre>';
//}
?>
<?php $form = ActiveForm::begin() ?>
<?= $form->field($model, 'email') ?>
<?= Html::submitButton('Send', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end() ?>

<!--<form method="post">-->
<!--    <p>Email:</p>-->
<!--    <input type="text" name="email" />-->
<!--    <br><br>-->
<!--    <input type="submit" />-->
<!--</form>-->


