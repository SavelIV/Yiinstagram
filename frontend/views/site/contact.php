<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use frontend\widgets\newsList\NewsList;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Html::encode(Yii::t('menu', 'Contact'));
?>
<div class="site-contact">
    <h1><?php echo Yii::t('contact', 'Contact page'); ?></h1>

    <div class="row">
        <div class="col-sm-6">
            <p>
                <?php echo Yii::t('contact', 'If you have any questions, please fill out the following form to contact us. Thank you.'); ?>
            </p>

            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('contact', 'Submit'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-sm-3 pull-right">
            <h2><?php echo Yii::t('about','Last news:'); ?></h2>
            <?php echo NewsList::widget();?>
        </div>
    </div>

</div>
