<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = "Admin Panel: ".Html::encode(Yii::$app->name);;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Admin Panel</h1>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Complaints</h2>

                <p>Sometimes people post offensive things...</p>

                <p><a class="btn btn-default" href="<?php echo Url::to(['/complaints/manage']); ?>">Manage</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Users</h2>

                <p>If You want to look on some users.</p>

                <p><a class="btn btn-default" href="<?php echo Url::to(['/user/manage']); ?>">Manage</a></p>

            </div>

        </div>

    </div>
</div>
