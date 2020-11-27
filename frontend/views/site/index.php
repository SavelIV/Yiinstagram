<?php

/* @var $this yii\web\View */
/* @var $users frontend\models\User */
/* @var $feedItems [] frontend\models\Feed */

/* @var $currentUser frontend\models\User */

use yii\web\JqueryAsset;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use frontend\widgets\newsList\NewsList;

$this->title = Html::encode(Yii::$app->name);

?>

    <div class="jumbotron">
        <h1>Welcome!</h1>
        <h2>Hello,
        <?php if (Yii::$app->user->identity): ?>
            <div class="photo center-block">
                <img id="profile-picture" class="author-image" src="<?php echo $currentUser->getPicture(); ?>"/>
            </div>
            <?php echo Yii::$app->user->identity->username; ?></h2>
        <p class="lead">Nice to see You.</p>
        <?php else: ?>
            <?php echo "user. Please register or login to see all features."; ?></h2>
        <?php endif; ?>

        <p><a class="btn btn-lg btn-success" href="<?php echo Url::to(['newsletter/subscribe']); ?>">Subscribe to
                Newsletters</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4 text-center">
                <h2>Last News:</h2>
                <hr>
                <?php echo NewsList::widget(['showLimit' => 12]); ?>
            </div>
            <div class="col-lg-4 text-center">
                <h2>Most active users:</h2>
                <hr>
                <?php foreach ($users as $user): ?>
                    <div class="photo center-block">
                        <img class="author-image" id="profile-picture" src="<?php echo $user->getPicture(); ?>"/>
                    </div>
                    <a href="<?php echo Url::to(['/user/profile/view', 'nickname' => $user->getNickname()]); ?>"
                       data-toggle="tooltip" title="<?php echo Html::encode($user['about']); ?>">
                        <?php echo Html::encode($user->username); ?>
                    </a>
                    <hr>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-4 text-center">
                <h2>Last Posts:</h2>
                <?php if (Yii::$app->user->identity): ?>
                    <hr>
                    <?php if ($feedItems): ?>
                        <?php foreach ($feedItems as $feedItem): ?>
                            <?php /* @var $feedItem Feed */ ?>

                            <!-- feed item -->
                            <div class="page page-post">
                                <div class="blog-posts">
                                    <article class="post">
                                        <div class="post-meta">
                                            <div class="post-title">
                                                <img class="author-image"
                                                     src="<?php echo $feedItem->author_picture; ?>"/>
                                                <div class="author-name text-center">
                                                    <a href="<?php echo Url::to(['/user/profile/view', 'nickname' => ($feedItem->author_nickname) ? $feedItem->author_nickname : $feedItem->author_id]); ?>">
                                                        <?php echo Html::encode($feedItem->author_name); ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="post-type-image center-block">
                                            <a href="<?php echo Url::to(['/post/default/view', 'id' => $feedItem->post_id]); ?>">
                                                <img src="<?php echo Yii::$app->storage->getFile($feedItem->post_filename); ?>"
                                                     alt=""/>
                                            </a>
                                        </div>
                                        <div class="post-description">
                                            <p><?php echo HtmlPurifier::process(Yii::$app->stringHelper->getShort($feedItem->post_description)) . '...'; ?></p>
                                        </div>
                                        <div class="post-date">
                                            <span><?php echo Yii::$app->formatter->asDatetime($feedItem->post_created_at); ?></span>
                                        </div>
                                        <div class="post-bottom">
                                            <div class="post-likes">
                                                <i class="fa fa-lg fa-heart-o"></i>
                                                <span class="likes-count"><?php echo $feedItem->countLikes(); ?></span>
                                                &nbsp;&nbsp;&nbsp;
                                                <?php if ($currentUser && $currentUser['id'] != $feedItem['author_id']): ?>
                                                    <a href="#"
                                                       class="btn btn-danger button-unlike <?php echo ($currentUser->isLikedPost($feedItem->post_id)) ? "" : "display-none"; ?>"
                                                       data-id="<?php echo $feedItem->post_id; ?>">
                                                        Unlike&nbsp;&nbsp;<span
                                                                class="glyphicon glyphicon-thumbs-down"></span>
                                                    </a>
                                                    <a href="#"
                                                       class="btn btn-success button-like <?php echo ($currentUser->isLikedPost($feedItem->post_id)) ? "display-none" : ""; ?>"
                                                       data-id="<?php echo $feedItem->post_id; ?>">
                                                        Like&nbsp;&nbsp;<span
                                                                class="glyphicon glyphicon-thumbs-up"></span>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                            <div class="post-comments">
                                                <a href="#">0 Comments</a>
                                            </div>
                                            <div class="post-report">
                                                <?php if (!$feedItem->isReported($currentUser)): ?>
                                                    <a href="#" class="btn btn-default button-complain"
                                                       data-id="<?php echo $feedItem->post_id; ?>">
                                                        Report post <i class="fa fa-cog fa-spin fa-fw icon-preloader"
                                                                       style="display:none"></i>
                                                    </a>
                                                <?php else: ?>
                                                    <p>Post has been reported</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </div>
                            <!-- feed item -->
                        <?php endforeach; ?>

                    <?php else: ?>
                        <div class="text-center">
                            None of Your friends posted yet!
                        </div>
                    <?php endif; ?>

                <?php else: ?>
                    <p>seen after login.</p>
                    <h2>Search</h2>
                    <hr>
                    <a href="<?php echo Url::to(['search/index']); ?>">Full Text Search</a>
                    <hr>
                    <a href="<?php echo Url::to(['search/advanced']); ?>">Sphinx Search</a>
                <?php endif; ?>

            </div>
        </div>
    </div>

<?php
//Register tooltip/popover initialization javascript
$this->registerJsFile('@web/js/bs3-tooltips-and-popovers.js', ['depends' => \yii\web\JqueryAsset::class,]);
//Register likes javascript
$this->registerJsFile('@web/js/likes.js', [
    'depends' => JqueryAsset::class,
]);
//Register complaints javascript
$this->registerJsFile('@web/js/complaints.js', [
    'depends' => JqueryAsset::class,
]);