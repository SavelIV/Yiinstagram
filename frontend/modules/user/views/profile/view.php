<?php
/* @var $this yii\web\View */
/* @var $user frontend\models\User */
/* @var $currentUser frontend\models\User */
/* @var $modelPicture frontend\modules\user\models\forms\PictureForm */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use dosamigos\fileupload\FileUpload;

$this->title = Html::encode($user->username);

?>
    <div class="page-posts no-padding">
        <div class="row">
            <div class="page page-post col-sm-12 col-xs-12">
                <div class="blog-posts blog-posts-large">
                    <div class="row">
                        <!-- profile -->
                        <article class="profile col-sm-12 col-xs-12">
                            <div class="profile-title">
                                <img id="profile-picture" class="author-image"
                                     src="<?php echo $user->getPicture(); ?>"/>
                                <div class="author-name">
                                    <?php echo Html::encode($user->username); ?>
                                </div>
                                <?php if ($currentUser && $currentUser->equals($user)): ?>
                                    <?=
                                    FileUpload::widget([
                                        'model' => $modelPicture,
                                        'attribute' => 'picture',
                                        'url' => ['/user/profile/upload-picture'], // your url, this is just for demo purposes,
                                        'options' => ['accept' => 'image/*'],
                                        'clientEvents' => [
                                            'fileuploaddone' => 'function(e, data) {
                                            if (data.result.success) {
                                                $("#profile-image-success").show();
                                                $("#profile-image-fail").hide();
                                                $("#profile-picture").attr("src", data.result.pictureUri);
                                            } else {
                                                $("#profile-image-fail").html(data.result.errors.picture).show();
                                                $("#profile-image-success").hide();
                                            }
                                        }',
                                        ],
                                    ]);
                                    ?>
                                    <a href="#" class="btn btn-default">Edit profile</a>

                                <?php endif; ?>
                                <br/>
                                <br/>
                                <div class="alert alert-success display-none fade in" id="profile-image-success">
                                    Profile image updated
                                </div>
                                <div class="alert alert-danger display-none fade in" id="profile-image-fail"></div>


                            </div>

                            <?php if ($currentUser && !$currentUser->equals($user)): ?>
                                <a href="<?php echo Url::to(['/user/profile/unsubscribe', 'id' => $user->getId()]); ?>"
                                   class="btn btn-info <?php echo ($currentUser && $currentUser->isFollowUser($user->getId())) ? "" : "display-none"; ?>">Unsubscribe</a>
                                <a href="<?php echo Url::to(['/user/profile/subscribe', 'id' => $user->getId()]); ?>"
                                   class="btn btn-info <?php echo ($currentUser && $currentUser->isFollowUser($user->getId())) ? "display-none" : ""; ?>">Subscribe</a>
                                <hr>
                                <h5>Friends, who are also following <?php echo Html::encode($user->username); ?>: </h5>
                                <div class="row">
                                    <?php foreach ($currentUser->getMutualSubscriptionsTo($user) as $item): ?>
                                        <div class="col-md-12">
                                            <a href="<?php echo Url::to(['/user/profile/view', 'nickname' => ($item['nickname']) ? $item['nickname'] : $item['id']]); ?>"
                                               data-toggle="tooltip"
                                               title="<?php echo Html::encode($item['about']); ?>">
                                                <?php echo Html::encode($item['username']); ?>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <hr>
                            <?php endif; ?>

                            <?php if ($user->about): ?>
                                <div class="profile-description">
                                    <p><?php echo HtmlPurifier::process($user->about); ?></p>
                                </div>
                            <?php endif; ?>

                            <div class="profile-bottom">
                                <div class="profile-post-count">
                                    <span><?php echo $user->getPostCount(); ?> posts</span>
                                </div>
                                <div class="profile-followers">
                                    <a href="#" data-toggle="modal"
                                       data-target="#myModal2"><?php echo $user->countFollowers(); ?> followers</a>
                                </div>
                                <div class="profile-following">
                                    <a href="#" data-toggle="modal"
                                       data-target="#myModal1"><?php echo $user->countSubscriptions(); ?> following</a>
                                </div>
                            </div>

                        </article>

                        <div class="col-sm-12 col-xs-12">
                            <div class="row profile-posts box-flex">
                                <?php foreach ($user->getPosts() as $post): ?>
                                    <div class="col-md-4 profile-post box-flex-img">
                                        <a href="<?php echo Url::to(['/post/default/view', 'id' => $post->getId()]); ?>">
                                            <img src="<?php echo Yii::$app->storage->getFile($post->filename); ?>"
                                                 class="author-image"/>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Following-->
    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Following:</h4>
                </div>
                <div class="modal-body">
                    <?php foreach ($user->getSubscriptions() as $subscription): ?>
                        <div>
                            <a href="<?php echo Url::to(['/user/profile/view', 'nickname' => ($subscription['nickname']) ? $subscription['nickname'] : $subscription['id']]); ?>">
                                <?php echo Html::encode($subscription['username']); ?>
                            </a>
                            <a tabindex="0" class="btn btn-small btn-default" role="button" data-toggle="popover"
                               data-trigger="focus" title="About:"
                               data-content="<?php echo Html::encode($subscription['about']); ?>">About
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Followers-->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Followers:</h4>
                </div>
                <div class="modal-body">
                    <?php foreach ($user->getFollowers() as $follower): ?>
                        <div>
                            <a href="<?php echo Url::to(['/user/profile/view', 'nickname' => ($follower['nickname']) ? $follower['nickname'] : $follower['id']]); ?>">
                                <?php echo Html::encode($follower['username']); ?>
                            </a>
                            <a tabindex="0" class="btn btn-small btn-default" role="button" data-toggle="popover"
                               data-trigger="focus" title="About:"
                               data-content="<?php echo Html::encode($follower['about']); ?>">About
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!--    Register tooltip/popover initialization javascript-->
<?php $this->registerJsFile('@web/js/bs3-tooltips-and-popovers.js', ['depends' => \yii\web\JqueryAsset::class,]);