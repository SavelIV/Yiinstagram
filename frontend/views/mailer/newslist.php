<?php

use yii\helpers\Html;

/* @var $newsList [] array */

?>

<?php foreach ($newsList as $item): ?>

    <?php $newsLink = Yii::$app->urlManager->createAbsoluteUrl(['news/' . $item['id']]); ?>

    <h1><?php echo Html::a(Html::encode($item['title']), $newsLink); ?></h1>

    <?php echo Html::a(Html::img('https://source.unsplash.com/400x180/?surf'), $newsLink); ?>

    <p><?php echo $item['content']; ?>...</p>

    <hr>

<?php endforeach;
