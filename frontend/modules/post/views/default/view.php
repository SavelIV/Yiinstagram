<?php
/* @var $this yii\web\View */
/* @var $currentUser frontend\models\User */
/* @var $post frontend\models\Post */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model CommentForm */
/* @var $comments Comment */

use frontend\models\CommentForm;
use frontend\models\Comment;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Html::encode(Yii::t('post', '{username}`s post', [
    'username' => $post->user->username
]));
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
            </div>&nbsp;
            <div class="post-image">
                <img src="<?php echo $post->getImage(); ?>"/>
            </div>&nbsp;
            <div class="post-description">
                <p><?php echo HtmlPurifier::process($post->description); ?></p>
            </div>
            <div class="post-date">
                <span><?php echo Yii::$app->formatter->asDatetime($post->created_at); ?></span>
            </div>
            <hr>
            <div class="alert alert-success display-none fade in" id="liked-success"><?php echo Yii::t('post', 'Liked!'); ?></div>
            <div class="alert alert-danger display-none fade in" id="unliked-success"><?php echo Yii::t('post', 'Unliked!'); ?></div>
            <div class="alert alert-info display-none fade in" id="reported-success"><?php echo Yii::t('post', 'Post has been reported!'); ?></div>
            <div class="alert alert-warning display-none fade in" id="unreported-success"><?php echo Yii::t('post', 'Undone!'); ?></div>
            <div class="post-bottom">
                <div class="post-likes">
                    <i class="fa fa-lg fa-heart-o"></i>
                    <span class="likes-count"><?php echo $post->countLikes(); ?></span>
                    <?php if ($currentUser && !$currentUser->equals($post->user)): ?>
                        <a href="#" class="btn btn-danger button-unlike
                        <?php echo ($currentUser && $post->isLikedBy($currentUser)) ? "" : "display-none"; ?>"
                           data-id="<?php echo $post->id; ?>">
                            <?php echo Yii::t('home', 'Unlike'); ?>&nbsp;&nbsp;<span
                                    class="glyphicon glyphicon-thumbs-down"></span>
                        </a>
                        <a href="#" class="btn btn-success button-like
                        <?php echo ($currentUser && $post->isLikedBy($currentUser)) ? "display-none" : ""; ?>"
                           data-id="<?php echo $post->id; ?>">
                            <?php echo Yii::t('home', 'Like'); ?>&nbsp;&nbsp;<span
                                    class="glyphicon glyphicon-thumbs-up"></span>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="post-comments">
                    <a href="<?php echo Url::to(['/post/default/view', 'id' => $post->id]); ?>">
                        <?php echo Yii::t('comment', 'Comments:'); ?>
                        <?php echo ($post->countComments()) ? $post->countComments() : 0; ?>
                    </a>
                </div>
                <?php if ($currentUser && !$currentUser->equals($post->user)): ?>
                    <div class="post-report">
                        <span class="text-danger <?php echo ($post->isReported($currentUser)) ? "" : "display-none"; ?>">
                            <?php echo Yii::t('home', 'Post has been reported!'); ?>
                        </span>
                        <a href="#"
                           class="btn btn-default button-complain <?php echo ($post->isReported($currentUser)) ? "display-none" : ""; ?>"
                           data-id="<?php echo $post->id; ?>">
                            <?php echo Yii::t('home', 'Report post'); ?>
                            <i class="fa fa-cog fa-spin fa-fw icon-preloader" style="display:none"></i>
                        </a>
                        <a href="#"
                           class="btn btn-default button-undo <?php echo ($post->isReported($currentUser)) ? "" : "display-none"; ?>"
                           data-id="<?php echo $post->id; ?>">
                            <?php echo Yii::t('home', 'Undo'); ?>
                            <i class="fa fa-cog fa-spin fa-fw icon-preloader" style="display:none"></i>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if ($comments): ?>
                    <h1><?php echo Yii::t('comment', 'Comments:'); ?></h1>
                    <?php foreach ($comments as $comment): ?>
                        <div class="post-title">
                            <img class="author-image" src="<?php echo $comment->user->getPicture(); ?>"/>
                            <div class="author-name">
                                <a href="<?php echo Url::to(['/user/profile/view', 'nickname' => ($comment->user->nickname) ? $comment->user->nickname : $comment->user->id]); ?>">
                                    <?php echo Html::encode($comment->user->username); ?>
                                </a>
                            </div>
                            <div class="post-date">
                                <p><?php echo Yii::$app->formatter->asDatetime($comment->created_at); ?></p>
                            </div>
                            <div class="post-comment">
                                <p><?php echo Html::encode($comment->text); ?></p>
                            </div>
                            <?php if (($currentUser->id) == ($post->user->id)): ?>
                                <div class="post-button">
                                    <a href="<?php echo Url::to(['/post/default/delete-comment', 'commentId' => $comment->id]); ?>"
                                       class="btn btn-default"><?php echo  Yii::t('comment', 'delete'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <hr>
                <?php if( Yii::$app->session->hasFlash('deleted') ): ?>
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <?php echo Yii::$app->session->getFlash('deleted'); ?>
                    </div>
                <?php endif;?>
                <?php if( Yii::$app->session->hasFlash('added') ): ?>
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                        <?php echo Yii::$app->session->getFlash('added'); ?>
                    </div>
                <?php endif;?>

                <div class="comment-form">

                    <p>
                        <?php echo Yii::t('comment', 'Please leave Your comments here.'); ?>
                    </p>
                    <div class="row">
                        <div class="col-lg-5">
                            <?php $form = ActiveForm::begin(['id' => 'comment-form']); ?>
                            <?= $form->field($model, 'text')->textarea(['rows' => 2, 'autofocus' => true]) ?>
                            <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                                'captchaAction' => '/site/captcha',
                                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                            ]) ?>
                            <div class="form-group">
                                <?= Html::submitButton(Yii::t('comment', 'Submit'), ['class' => 'btn btn-primary', 'name' => 'comment-button']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
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
