<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Update User: ' . $model->id;
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="user-form">

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
                'email',

            ],
        ]) ?>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username')->textInput() ?>
        <?= $form->field($model, 'nickname')->textInput() ?>
        <?= $form->field($model, 'about')->textarea(['rows' => 5]) ?>

        <div class="form-group">
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
