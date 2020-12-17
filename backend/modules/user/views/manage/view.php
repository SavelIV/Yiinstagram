<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->id;

?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this user?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'picture',
                'format' => 'raw',
                'value' => function ($user) {
                    /* @var $post \backend\models\User */
                    return Html::img($user->getPicture(), ['width' => '300px']);
                },
            ],
            'username',
            'nickname',
            'email:email',
            'status',
            'created_at:datetime',
            'updated_at:datetime',
            'about:ntext',
            'type',
            [
                'attribute' => 'roles',
                'value' => function($user) {
                    /* @var $user User */
                    return implode(', ', $user->getRoles());
                }
            ],
        ],
    ]) ?>

</div>
