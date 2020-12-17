<?php
/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use frontend\assets\AppAsset;
use frontend\assets\FontAwesomeAsset;
use common\widgets\Alert;

AppAsset::register($this);
FontAwesomeAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<?php $this->beginBody() ?>
<body class="home page">
<div class="wrapper">
    <header>
        <div class="header-top">
            <div class="container">
                <div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4 brand-logo">
                    <a href="<?php echo Url::to(['/site/index']); ?>">
                        <img src="/img/logo.png" alt="">
                    </a>
                </div>
                <div class="col-md-4 col-sm-4 navicons-topbar">
                    <ul>
                        <li class="blog-search">
                            <a href="<?php echo Url::to(['search/index']); ?>" title="<?php echo Yii::t('menu', 'Site search') ?>"><i class="fa fa-search"></i></a>
                        </li>
                        <li>
                            <?= Html::beginForm(['/site/language']) ?>
                            <?= Html::dropDownList('language', Yii::$app->language, ['en-US' => 'English', 'ru-RU' => 'Русский']) ?>
                            <?= Html::submitButton('Change') ?>
                            <?= Html::endForm() ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="header-main-nav custom navbar navbar-default">
            <div class="container">
                <div class="content-center">
                    <nav class="main-menu">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                    data-target="#bs-example-navbar-collapse-1">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <?php
                        $menuItems = [
                            ['label' => Yii::t('menu', 'Home'), 'url' => ['/site/index']],
                            ['label' => Yii::t('menu', 'About'), 'url' => ['/site/about']],
                            ['label' => Yii::t('menu', 'Contact'), 'url' => ['/site/contact']],
                        ];
                        if (Yii::$app->user->isGuest) {
                            $menuItems[] = ['label' => Yii::t('menu', 'Register'), 'url' => ['/user/default/signup']];
                            $menuItems[] = ['label' => Yii::t('menu', 'Login'), 'url' => ['/user/default/login']];
                        } else {
                            $menuItems[] = ['label' => Yii::t('menu', 'Profile actions'),
                                'items' => [
                                    ['label' => '<i class="fa fa-angle-double-right"></i> ' . Yii::t('menu', 'My profile'), 'url' => ['/user/profile/view', 'nickname' => Yii::$app->user->identity->getNickname()]],
                                    ['label' => '<i class="fa fa-angle-double-right"></i> ' . Yii::t('menu', 'Newsfeed'), 'url' => ['/site/newsfeed']],
                                    ['label' => '<i class="fa fa-angle-double-right"></i> ' . Yii::t('menu', 'Create post'), 'url' => ['/post/default/create']],
                                ],
                            ];
                            $menuItems[] = '<li>'
                                . Html::beginForm(['/user/default/logout'], 'post')
                                . Html::submitButton(
                                    Yii::t('menu', 'Logout ({username})', [
                                        'username' => Html::encode(Yii::$app->user->identity->username)
                                    ]) . ' <i class="fa fa-sign-out"></i>', ['class' => 'btn btn-link logout']
                                )
                                . Html::endForm()
                                . '</li>';
                        }
                        echo Nav::widget([
                            'options' => ['class' => 'menu navbar-nav collapse navbar-collapse', 'id' => "bs-example-navbar-collapse-1"],
                            'activateParents' => true,
                            'encodeLabels' => false,
                            'items' => $menuItems,
                        ]);
                        ?>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <div class="container full">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
    <!--   to push footer to bottom-->
    <div class="push"></div>
</div>
<footer>
    <div class="footer">
        <div class="back-to-top-page">
            <a class="back-to-top"><i class="fa fa-angle-double-up"></i></a>
        </div>
        <p class="text">
            <a href="<?php echo Url::to(['/site/about']); ?>">
                &copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?>
            </a>
        </p>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
