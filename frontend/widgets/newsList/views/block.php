<?php 
use yii\helpers\Url;

 foreach ($list as $item): ?>
        <h4><a href ="<?php echo Url::to(['test/view', 'id' => $item['id']]); ?>">
            <?php echo $item['title']; ?>
            </a>
        </h4>
        <p><?php echo $item['content']; ?>...</p>
        <hr>
<?php
endforeach;

