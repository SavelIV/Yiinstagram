<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'format' => 'raw',
                'value' => function ($post) {
                    /* @var $post \backend\models\Post */
                    return Html::a($post->id, ['view', 'id' => $post->id],['title' => 'View post']);
                },
            ],
            'user_id',
            [
                'label' => 'filename',
                'format' => 'raw',
                'value' => function($post){
                    /* @var $post \backend\models\Post */
                    return Html::img($post->getImage(),[
                        'alt'=>'post picture',
                        'title' => 'Picture',
                        'style' => 'width:250px;'
                    ]);
                },
            ],
            'description:ntext',
            'created_at:datetime',
            'complaints',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}&nbsp;&nbsp;&nbsp;{approve}&nbsp;&nbsp;&nbsp;{delete}',
                'buttons' => [
                    'approve' => function ($url, $post) {
                        return Html::a('<span class="glyphicon glyphicon-ok"></span>', ['approve', 'id' => $post->id],['title' => 'Approve']);
                    },
                ],
            ],
        ],
    ]); ?>


</div>
