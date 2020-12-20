<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\widgets\newsList\NewsList;

$this->title = Html::encode(Yii::t('menu', 'About'));


?>
<div class="site-about">
    <div class="row">
        <div class="col-sm-6">
            <h1><?php echo Yii::t('about', 'About this project:'); ?></h1>
            <hr>

            <p><?php echo Yii::t('about', 'Yiinstagram is a small analogue of the well-known resource for sharing photos and various information, built on Yii2 framework.'); ?></p>

            <p><?php echo Yii::t('about', 'The goal is to keep photo diaries online, the ability to make friends and make acquaintances, share photos and impressions, follow the latest world news and the news of friends.'); ?></p>

            <p><?php echo Yii::t('about', 'Key features:'); ?></p>

            <li><?php echo Yii::t('about', 'Creating and editing of your own profile.'); ?></li>
            <li><?php echo Yii::t('about', 'Uploading and publishing of your profile photos.'); ?></li>
            <li><?php echo Yii::t('about', 'The ability to make friends and subscribe to other network members.'); ?></li>
            <li><?php echo Yii::t('about', 'Update feed with the ability to comment and like.'); ?></li>
            <li><?php echo Yii::t('about', 'Authorization through various social networks.'); ?></li>
            <li><?php echo Yii::t('about', 'Subscription to the daily newsletters.'); ?></li>
            <li><?php echo Yii::t('about', 'Alerts page: likes and subscriptions to the user`s profile.'); ?></li>
            <li><?php echo Yii::t('about', 'Pages with lists of subscriptions and followers.'); ?></li>
            <li><?php echo Yii::t('about', 'Full-text search for publications.'); ?></li>
            <li><?php echo Yii::t('about', 'Ability to send complaints about other members publications.'); ?></li>
            <li><?php echo Yii::t('about', 'Administrative panel for handling complaints and managing users.'); ?></li>
            <hr>

            <p><?php echo Yii::t('about', 'This project is made on the Yii2 framework using MySQL, Redis (likes, dislikes, subscriptions, followers, complaints about posts), Sphinx (full-text search).'); ?></p>
            <p><?php echo Yii::t('about', 'There is oAuth authorization implemented, console mail scripts run.'); ?></p>
            <p><?php echo Yii::t('about', 'There is original principles of user files storing are applied, the watermark is used (intervention library).'); ?></p>
            <p><?php echo Yii::t('about', 'The high performance news feed (user posts) is formed (instant updates for all subscribers).'); ?></p>
            <p><?php echo Yii::t('about', 'Hourly updated by cron parser of the leading Russian news Internet sites is implemented.'); ?></p>
            <p><?php echo Yii::t('about', 'The administration system is based on roles (RBAC).'); ?></p>
            <p><?php echo Yii::t('about', 'Full internationalization done (i18n).'); ?></p>
            <p><?php echo Yii::t('about', 'Functional and unit tests are written.'); ?></p>

        </div>
        <div class="col-sm-3 pull-right">
            <h2><?php echo Yii::t('about', 'Last news:'); ?></h2>
            <?php echo NewsList::widget(); ?>
        </div>

    </div>
</div>
