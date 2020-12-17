<?php
/* @var $size \frontend\widgets\newsList\NewsList */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;


?>
<?php $newsLink = Yii::$app->urlManager->createAbsoluteUrl(['news/' . $model['id']]); ?>

<h4><?php echo Html::a(Html::encode($model['title']), $newsLink); ?></h4>
<?php echo Html::a(Html::img($model['picture'], ['width'=> $size]), $newsLink); ?>

<p><?php echo HtmlPurifier::process(Yii::$app->stringHelper->getShort($model['content'])); ?>...</p>
<hr>

