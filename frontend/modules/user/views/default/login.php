<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';

?>
<div class="site-login">
    <div class="row">
        <div class="col-lg-6">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>Please fill out the following fields to login:</p>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div style="color:#999;margin:1em 0">
                If you forgot your password you can <?= Html::a('reset it', ['default/request-password-reset']) ?>.
            </div>

            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-6 ">
            <h3 class="text-center">Or login with:</h3><br>
            <?php

            use yii\authclient\widgets\AuthChoice; ?>
            <?php
            $authAuthChoice = AuthChoice::begin([
                'baseAuthUrl' => ['default/auth']
            ]);
            ?>

            <?php foreach ($authAuthChoice->getClients() as $client): ?>

                <?= $authAuthChoice->clientLink($client) ?><br>

            <?php endforeach; ?>
            <?php AuthChoice::end(); ?>
        </div>
    </div>
</div>
