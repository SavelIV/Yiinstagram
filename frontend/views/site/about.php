<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\widgets\newsList\NewsList;

$this->title = Html::encode(Yii::t('menu', 'About'));


?>
<div class="site-about">
    <div class="row">
        <div class="col-md-9">
            <h1><?php echo Yii::t('about', 'About this project'); ?></h1>

            <p><?php echo Yii::t('about','Coming soon...'); ?></p>

        </div>
        <div class="col-md-3">
          <h2><?php echo Yii::t('about','Last news:'); ?></h2>
          <?php echo NewsList::widget(['showLimit' => 5]);?>  
        </div>
    
   </div> 
</div>
