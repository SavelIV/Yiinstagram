<?php
/* @var $this yii\web\View */
/* @var $currentUser frontend\models\User */
/* @var $feedItems [] frontend\models\Feed */

use frontend\widgets\postsList\PostsList;
use yii\web\JqueryAsset;
use yii\helpers\Html;


$this->title =  Html::encode(Yii::t('menu', 'Newsfeed'));
?>
    <div class="page-posts no-padding">
        <div class="row">
            <div class="page page-post col-sm-12 col-xs-12">
                <div class="blog-posts blog-posts-large">
                    <div class="row">
                        <?php if ($feedItems): ?>
                            <?php echo PostsList::widget(); ?>
                        <?php else: ?>
                            <div class="col-md-12">
                                <?php echo Yii::t('home', 'None of Your friends posted yet!'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
$this->registerJsFile('@web/js/likes.js', [
    'depends' => JqueryAsset::class,
]);
$this->registerJsFile('@web/js/complaints.js', [
    'depends' => JqueryAsset::class,
]);
