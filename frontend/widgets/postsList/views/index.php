<?php

/* @var $currentUser frontend\widgets\postsList\PostsList */
/* @var $dataProvider frontend\widgets\postsList\PostsList */

use yii\widgets\ListView;

?>

<?php echo ListView::widget([

    'dataProvider' => $dataProvider,
    'itemOptions' => ['class' => 'item'],
    'itemView' => 'block',
    'viewParams' => [
        'currentUser' => $currentUser
    ],
    'pager' => [
        'class' => \kop\y2sp\ScrollPager::class,
        'triggerText' => Yii::t('flash', 'Show more posts'),
    ]
    ]);



