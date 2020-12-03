<?php
/* @var $model  frontend\models\SearchForm */
/* @var $results [] frontend\controllers\SearchController */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use frontend\helpers\HighlightHelper;

$this->title = Html::encode(Yii::t('flash', 'Search'));
?>
<h1><?php echo Yii::t('flash', 'Search'); ?></h1>

<div class="row">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin(); ?>
        
        <?php echo $form->field($model, 'keyword'); ?>
        
        <?php echo Html::submitButton(Yii::t('flash', 'Search'), ['class' => 'btn btn-primary']); ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <?php if ($results): ?>
            <?php foreach ($results as $item): ?>
                <?php echo $item['title']; ?>
                <hr>
                <?php echo HighlightHelper::process($model->keyword, $item['content']); ?>
                <hr>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

