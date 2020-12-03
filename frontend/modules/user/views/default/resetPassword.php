<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model ResetPasswordForm */

use frontend\modules\user\models\ResetPasswordForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Html::encode(Yii::t('login', 'Reset password'));

?>
<div class="site-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?php echo Yii::t('login', 'Please choose your new password:'); ?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('login', 'Save'), ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
