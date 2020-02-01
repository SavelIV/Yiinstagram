<?php 

/* @var $this yii\web\View  */
/* @var $model frontend\models\Subscribe  */


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

if ($model->hasErrors()) {
    echo '<pre>';
    print_r($model->getErrors());
    echo '</pre>';
}
?>
<form method="post">
    <p>Email:</p>
    <input type="text" name="email" />
    <br><br>
    <input type="submit" />
</form>


