<?php

use yii\helpers\Url;
use frontend\widgets\newsList\NewsList;
?>

<div class = "row">
    <div class = "col-md-9">
        <h1>News:</h1>
        <?php foreach ($list as $item): ?>
            <h2><a href ="<?php echo Url::to(['test/view', 'id' => $item['id']]); ?>">
                    <?php echo $item['title']; ?>
                </a>
            </h2>
            <p><?php echo $item['content']; ?>...</p>
            <hr>
        <?php endforeach; ?>
    </div>
    <div class="col-md-3">
        <h2>More news:</h2>
        <?php echo NewsList::widget(['showLimit' => 10]); ?> 
    </div>
</div> 



