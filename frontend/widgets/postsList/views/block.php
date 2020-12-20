<?php
/* @var $size frontend\widgets\postsList\PostsList */
/* @var $model frontend\widgets\postsList\PostsList */
/* @var $currentUser frontend\models\User */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;


?>
<div class="page page-post">
    <div class="blog-posts">
        <article class="post">
            <div class="post-meta">
                <div class="post-title">
                    <img class="author-image"
                         src="<?php echo $model->author_picture; ?>" alt=""/>
                    <div class="author-name text-center">
                        <a href="<?php echo Url::to(['/user/profile/view', 'nickname' => ($model->author_nickname) ? $model->author_nickname : $model->author_id]); ?>">
                            <?php echo Html::encode($model->author_name); ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="post-type-image">
                <a href="<?php echo Url::to(['/post/default/view', 'id' => $model->post_id]); ?>">
                    <img src="<?php echo Yii::$app->storage->getFile($model->post_filename); ?>"
                         alt=""/>
                </a>
            </div>
            <div class="post-description">
                <p><?php echo HtmlPurifier::process(Yii::$app->stringHelper->getShort($model->post_description)) . '...'; ?></p>
            </div>
            <div class="post-date">
                <span><?php echo Yii::$app->formatter->asDatetime($model->post_created_at); ?></span>
            </div>
            <div class="post-bottom">
                <div class="post-likes">
                    <i class="fa fa-lg fa-heart-o"></i>
                    <span class="likes-count"><?php echo $model->countLikes(); ?></span>
                    &nbsp;&nbsp;&nbsp;
                    <?php if ($currentUser && $currentUser['id'] != $model['author_id']): ?>
                        <a href=""
                           class="btn btn-danger button-unlike <?php echo ($currentUser->isLikedPost($model->post_id)) ? "" : "display-none"; ?>"
                           data-id="<?php echo $model->post_id; ?>">
                            <?php echo Yii::t('home', 'Unlike'); ?>&nbsp;&nbsp;<span
                                    class="glyphicon glyphicon-thumbs-down"></span>
                        </a>
                        <a href=""
                           class="btn btn-success button-like <?php echo ($currentUser->isLikedPost($model->post_id)) ? "display-none" : ""; ?>"
                           data-id="<?php echo $model->post_id; ?>">
                            <?php echo Yii::t('home', 'Like'); ?>&nbsp;&nbsp;<span
                                    class="glyphicon glyphicon-thumbs-up"></span>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="post-comments">
                    <a href="<?php echo Url::to(['/post/default/view', 'id' => $model->post_id]); ?>">
                        <?php echo Yii::t('comment', 'Comments:'); ?><?php echo ($model->countComments()) ? $model->countComments() : 0; ?>
                    </a>
                </div>
                <div class="post-report">
                    <span class="text-danger <?php echo ($model->isReported($currentUser)) ? "" : "display-none"; ?>">
                        <?php echo Yii::t('home', 'Post has been reported!'); ?>
                    </span>
                    <a href=""
                       class="btn btn-default button-complain <?php echo ($model->isReported($currentUser)) ? "display-none" : ""; ?>"
                       data-id="<?php echo $model->post_id; ?>">
                        <?php echo Yii::t('home', 'Report post'); ?>
                        <i class="fa fa-cog fa-spin fa-fw icon-preloader" style="display:none"></i>
                    </a>
                    <a href=""
                       class="btn btn-default button-undo <?php echo ($model->isReported($currentUser)) ? "" : "display-none"; ?>"
                       data-id="<?php echo $model->post_id; ?>">
                        <?php echo Yii::t('home', 'Undo'); ?>
                        <i class="fa fa-cog fa-spin fa-fw icon-preloader" style="display:none"></i>
                    </a>
                </div>
            </div>
        </article>
    </div>
</div>
