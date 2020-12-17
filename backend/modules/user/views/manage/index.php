<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';

?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'picture',
                'format' => 'raw',
                'value' => function ($user) {
                    /* @var $post \backend\models\User */
                    return Html::img($user->getPicture(), ['class' => 'author-image']);
                },
            ],
            'id',
            'username',
            'nickname',
            'email:email',
            'created_at:datetime',
            [
                'attribute' => 'roles',
                'value' => function ($user) {
                    /* @var $user User */
                    return implode(', ', $user->getRoles());
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}&nbsp;&nbsp;&nbsp;{update}&nbsp;&nbsp;&nbsp;{delete}',
            ],
        ],
    ]); ?>


</div>
