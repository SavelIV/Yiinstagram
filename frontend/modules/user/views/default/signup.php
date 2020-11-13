<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Register';

?>
<div class="site-signup">
    <div class="row">
        <div class="col-lg-6">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>Please fill out the following fields to register:</p>

            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-4">
            <h3 class="text-center">Or register with:</h3><br>
            <?php

            use yii\authclient\widgets\AuthChoice; ?>
            <?php
            $authAuthChoice = AuthChoice::begin([
                'baseAuthUrl' => ['default/auth']
            ]);
            ?>

            <?php foreach ($authAuthChoice->getClients() as $client): ?>

                <?= $authAuthChoice->clientLink($client) ?>
                <br>

            <?php endforeach; ?>
            <?php AuthChoice::end(); ?>
        </div>
    </div>
</div>
