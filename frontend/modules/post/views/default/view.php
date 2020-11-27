<?php
/* @var $this yii\web\View */
/* @var $currentUser frontend\models\User */

/* @var $post frontend\models\Post */

use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

$this->title = Html::encode($post->user->username) . '`s post';
?>
    <div class="page page-post blog-posts">
        <div class="post post-default-index">
            <div class="row profile">
                <div class="profile-title">
                    <?php if ($post->user): ?>
                        <img id="profile-picture" class="author-image" src="<?php echo $post->user->getPicture(); ?>"/>
                        <div class="author-name" data-toggle="tooltip"
                             title="<?php echo Html::encode($post->user['about']); ?>">
                            <a href="<?php echo Url::to(['/user/profile/view', 'nickname' => ($post->user->nickname) ? $post->user->nickname : $post->user->id]); ?>">
                                <?php echo Html::encode($post->user->username); ?>
                            </a>
                        </div>

                    <?php endif; ?>
                </div>
            </div>
            &nbsp;
            <div class="post-image">
                <img src="<?php echo $post->getImage(); ?>"/>
            </div>
            &nbsp;
            <div class="post-description">
                <p><?php echo HtmlPurifier::process($post->description); ?></p>
            </div>
            <div class="post-date">
                <span><?php echo Yii::$app->formatter->asDatetime($post->created_at); ?></span>
            </div>

            <hr>
            <div class="alert alert-success display-none fade in" id="liked-success">Liked!</div>
            <div class="alert alert-danger display-none fade in" id="unliked-success">Unliked!</div>

            <div class="post-bottom">
                <div class="post-likes">
                    <i class="fa fa-lg fa-heart-o"></i>
                    <span class="likes-count"><?php echo $post->countLikes(); ?></span>
                    <?php if ($currentUser && !$currentUser->equals($post->user)): ?>
                        <a href="#" class="btn btn-danger button-unlike
        <?php echo ($currentUser && $post->isLikedBy($currentUser)) ? "" : "display-none"; ?>"
                           data-id="<?php echo $post->id; ?>">
                            Unlike&nbsp;&nbsp;<span class="glyphicon glyphicon-thumbs-down"></span>
                        </a>
                        <a href="#" class="btn btn-success button-like
       <?php echo ($currentUser && $post->isLikedBy($currentUser)) ? "display-none" : ""; ?>"
                           data-id="<?php echo $post->id; ?>">
                            Like&nbsp;&nbsp;<span class="glyphicon glyphicon-thumbs-up"></span>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="post-comments">
                    <a href="#">0 Comments</a>
                </div>
                <div class="post-report">
                    <?php if (!$post->isReported($currentUser)): ?>
                        <a href="#" class="btn btn-default button-complain"
                           data-id="<?php echo $post->id; ?>">
                            Report post <i class="fa fa-cog fa-spin fa-fw icon-preloader"
                                           style="display:none"></i>
                        </a>
                    <?php else: ?>
                        <p>Post has been reported</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<?php
$this->registerJsFile('@web/js/bs3-tooltips-and-popovers.js', [
    'depends' => JqueryAsset::class,
]);
$this->registerJsFile('@web/js/likes.js', [
    'depends' => JqueryAsset::class,
]);
$this->registerJsFile('@web/js/complaints.js', [
    'depends' => JqueryAsset::class,
]);
