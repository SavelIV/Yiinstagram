<?php
/* @var $this yii\web\View */
/* @var $currentUser frontend\models\User */
/* @var $post frontend\models\Post */

use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\helpers\Url;

$this->title = Html::encode($post->user->username).'`s post';
?>
    <div class="post-default-index">
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
            &nbsp;
            <div class="post-image">
                <img src="<?php echo $post->getImage(); ?>"/>
            </div>
            &nbsp;
            <div class="post-description">
                <?php echo Html::encode($post->description); ?>
            </div>
        </div>
        <hr>
        <div class="alert alert-success display-none fade in" id="liked-success">Liked!</div>
        <div class="alert alert-danger display-none fade in" id="unliked-success">Unliked!</div>

        <div class="col-md-12">
            <i class="fa fa-lg fa-heart-o"></i>
            <span class="likes-count"><?php echo $post->countLikes(); ?></span>

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

        </div>

    </div>

<?php
$this->registerJsFile('@web/js/bs3-tooltips-and-popovers.js', ['depends' => \yii\web\JqueryAsset::class,]);
$this->registerJsFile('@web/js/likes.js', [
    'depends' => JqueryAsset::class,
]);
