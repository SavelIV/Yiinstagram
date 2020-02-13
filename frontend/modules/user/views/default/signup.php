<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to register:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
         <div class="col-lg-5">
            <h3>Login with:</h3>
            <?php
            use yii\authclient\widgets\AuthChoice; ?>
            <?php
            $authAuthChoice = AuthChoice::begin([
                        'baseAuthUrl' => ['default/auth']
            ]);
            ?>

            <?php foreach ($authAuthChoice->getClients() as $client): ?>
           
                <?= $authAuthChoice->clientLink($client) ?>
          
            <?php endforeach; ?>
            <?php AuthChoice::end(); ?>
        </div>
    </div>
</div>
