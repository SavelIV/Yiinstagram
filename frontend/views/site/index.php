<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use frontend\widgets\newsList\NewsList;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome!</h1>
        
        <h2>Hello, <?php if(Yii::$app->user->identity) echo Yii::$app->user->identity->username; ?></h2>

        <p class="lead">You have come here fortunately.</p>

        <p><a class="btn btn-lg btn-success" href="<?php echo Url::to(['newsletter/subscribe']); ?>">Subscribe to Newsletters</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <h2>News:</h2>
                <?php echo NewsList::widget(['showLimit' => 2]);?>
            </div>
            <div class="col-lg-3">
                <h2>All users:</h2>
                <hr>
                <?php foreach ($users as $user): ?>
                    <a href="<?php echo Url::to(['/user/profile/view', 'id' => $user->id]); ?>">
                        <?php echo $user->username; ?>
                    </a>
                    <hr>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-3">
                <h2>Heading</h2>

                <a href="<?php echo Url::to(['search/index']); ?>">Full Text Search</a>
                <br>
                <a href="<?php echo Url::to(['search/advanced']); ?>">Sphinx Search</a>
            </div>
        </div>

    </div>
</div>
