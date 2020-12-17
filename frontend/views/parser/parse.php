<?php

/* @var $this yii\web\View */
/* @var $size frontend\controllers\ParserController */
/* @var $news frontend\controllers\ParserController */


use frontend\widgets\newsList\NewsList;
use yii\helpers\Html;

$this->title = Html::encode(Yii::t('menu', 'Newsfeed'));

?>
<div class="site-about">

    <div class="col-lg-12 text-center">
        <h1><?= Html::encode($this->title) ?></h1>
        <?php echo NewsList::widget( ['size' => 800]); ?>
    </div>

</div>




