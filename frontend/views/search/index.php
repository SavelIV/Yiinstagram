<?php

/* @var $model  frontend\models\SearchForm */
/* @var $searched  frontend\controllers\SearchController */
/* @var $results [] frontend\controllers\SearchController */

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use frontend\helpers\HighlightHelper;

$this->title = Html::encode(Yii::t('flash', 'Fulltext search'));
?>
<h1><?php echo Yii::t('flash', 'Fulltext search'); ?></h1>
<p><?php echo Yii::t('flash', 'Enter the whole word to search for site news.'); ?></p>

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
                <h4><a href="<?php echo Url::to(['parser/view', 'id' => $item['id']]); ?>">
                        <?php echo Html::encode($item['title']); ?>
                    </a>
                </h4>
                <?php echo Html::img($item['picture'], ['width'=>'300']); ?>
                <hr>
                <?php echo HighlightHelper::process($model->keyword, Html::encode($item['content'])); ?>
                <hr>
            <?php endforeach; ?>
        <?php elseif ($searched == 'yes'): ?>
            <p><?php echo Yii::t('flash', 'Nothing found.'); ?></p>
        <?php endif; ?>

    </div>
</div>

