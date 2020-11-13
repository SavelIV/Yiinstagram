<?php

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\widgets\newsList\NewsList;
?>

<div class="row">
    <div class="col-md-9">
        <h1><?php echo $item['title']; ?></h1>
        <hr>
        <?php echo Html::img('@images/'.  $item['status'] .'.jpg'); ?>
        <p><?php echo $item['content']; ?></p>
        <hr>
        <a href="<?php echo Url::to(['test/index']); ?>" class="btn btn-info">Back to all news</a>
    </div>
    <div class="col-md-3">
        <h2>More news:</h2>
        <?php echo NewsList::widget(['showLimit' => 3]);?> 
    </div>
</div> 