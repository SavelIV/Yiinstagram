<?php

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\widgets\newsList\NewsList;

?>

<div class="row">
    <div class="col-md-9">
        <h1>News:</h1>
        <?php if (!$list): ?>
        <hr>
        <p><?php echo "No News."; ?></p>
    </div>
    <?php else: ?>
    <?php foreach ($list as $item): ?>
        <h2><a href="<?php echo Url::to(['test/view', 'id' => $item['id']]); ?>">
                <?php echo $item['title']; ?>
            </a>
        </h2>
        <?php echo Html::img('@images/'.  $item['status'] .'.jpg'); ?>
        <p><?php echo $item['content']; ?>...</p>
        <hr>
    <?php endforeach; ?>

</div>
    <div class="col-md-3">
        <h2>More news:</h2>
        <?php echo NewsList::widget(['showLimit' => 10]); ?>
    </div>
<?php endif; ?>
</div>



