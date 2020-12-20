<?php

/* @var $size frontend\models\Parser */

/* @var $dataProvider frontend\controllers\ParserController */

use yii\widgets\ListView;

?>

<?php echo ListView::widget([

    'dataProvider' => $dataProvider,
    'itemOptions' => ['class' => 'item'],
    'itemView' => 'block',
    'viewParams' => [
        'size' => $size,
    ],
    'pager' => [
        'class' => \kop\y2sp\ScrollPager::class,
        'triggerText' => Yii::t('flash', 'Show more news'),
    ]
]);



