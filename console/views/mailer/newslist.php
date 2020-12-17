<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

/* @var $newsList [] array */
/* @var $subscriber [] array */

?>

<?php foreach ($newsList as $item): ?>

    <?php $newsLink = Yii::$app->urlManager->createAbsoluteUrl(['news/' . $item['id']]); ?>

    <h1><?php echo Html::a(Html::encode($item['title']), $newsLink); ?></h1>

    <a href="<?php echo $newsLink; ?>">
        <img src="<?php echo $item['picture']; ?>" width="300"/>
    </a>

    <p><?php echo HtmlPurifier::process($item['content']); ?>...</p>
    <hr>

<?php endforeach; ?>

<p> Больше новостей на сайте:
    <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['/']);?>">
        <?php echo Html::encode(Yii::$app->name);?>
    </a>
</p>
<p> <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['newsletter/unsubscribe/' . $subscriber['id']]);?>">
        Отписаться
    </a>
</p>
