<?php

/* @var $this yii\web\View */
/* @var $item frontend\controllers\ParserController */

use frontend\widgets\newsList\NewsList;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'News # '.$item['id'];
?>

<div class="row">
    <div class="col-sm-6">
        <h1><?php echo Html::encode($item['title']); ?></h1>
        <hr>
        <?php echo Html::img($item['picture'], ['width'=>'800']); ?>
        <hr>
        <p><?php echo Html::encode($item['content']); ?></p>
        <hr>
        <a href="<?php echo Url::to(['/']); ?>" class="btn btn-info"><?php echo Yii::t('about','All news'); ?></a>
    </div>
    <div class="col-sm-3 pull-right">
        <h2><?php echo Yii::t('about','Last news:'); ?></h2>
        <?php echo NewsList::widget();?>
    </div>

</div> 