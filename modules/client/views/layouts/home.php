<?php

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $user app\modules\admin\models\User */

use yii\helpers\Url;
use yii\helpers\Html;
use app\assets\ClientAsset;
use app\modules\admin\models\User;

ClientAsset::register($this);
?>

<?php $this->beginPage() ?>

<!DOCTYPE html>

<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="Content-Type" content="text/html">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/57d69475c9.js" crossorigin="anonymous"></script>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

    <div class="wrap">

        <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle">
            <i class="fa fa-bars" style="color:#fff;"></i>
        </a>
        <nav id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle">
                    <i class="fa fa-times"></i>
                </a>
                <li class="sidebar-brand">
                    <a href="<?= Url::to(['default/index']) ?>"><?= Yii::t('app', 'NAV_HOME') ?></a>
                </li>
                <li>
                    <a href="<?= Url::to(['biography']) ?>">
                        <?= Yii::t('app', 'NAV_BIOGRAPHY') ?>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['concerts']) ?>">
                        <?= Yii::t('app', 'NAV_CONCERTS') ?>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['media']) ?>">
                        <?= Yii::t('app', 'NAV_MEDIA') ?>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['music']) ?>">
                        <?= Yii::t('app', 'NAV_MUSIC') ?>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['projects']) ?>">
                        <?= Yii::t('app', 'NAV_PROJECTS') ?>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['repertoire']) ?>">
                        <?= Yii::t('app', 'NAV_REPERTOIRE') ?>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['contacts']) ?>">
                        <?= Yii::t('app', 'NAV_CONTACTS') ?>
                    </a>
                </li>
                <?php if (!Yii::$app->user->isGuest)
                    echo '<li>' . Html::a(Yii::t('app', 'NAV_ADMINISTRATION'), ['/admin/user/profile'],
                            ['data-method' => 'POST']) . '</li><li>' .
                        Html::a(Yii::t('app', 'NAV_SIGN_OUT'), ['sing-out']) . '</li>';
                ?>
                <li>
                    <?= Html::a(Yii::$app->language == 'ru-RU' ?
                        "<figure class='icon-lang icon-en'></figure> English" :
                        "<figure class='icon-lang icon-ru'></figure> Русский",
                        Yii::$app->language == 'ru-RU' ? '/en' .
                            Yii::$app->getRequest()->getLangUrl() : '/ru' .
                            Yii::$app->getRequest()->getLangUrl(),
                        ['class' => 'rd-nav-link']) ?>
                </li>
            </ul>
        </nav>
        <div class="home-header"></div>

        <?= $content ?>
    </div>

    <footer id="footer" class="footer-home">
        <div class="container footer-container">
            <div class="row footer-row">
                <div class="col-sm-4 text-left">&copy; <?= date('Y') . ' ' .
                    Yii::t('app', 'FOOTER_LOGO') ?></div>
                <div class="col-sm-4 text-center">
                    <?php if (User::find()->one()->youtube_link): ?>
                        <a href="<?= User::find()->one()->youtube_link ?>"><p class="fa-brands fa-youtube fa-lg footer-icon"></p></a>
                    <?php endif; ?>
                    <?php if (User::find()->one()->instagram_link): ?>
                        <a href="<?= User::find()->one()->instagram_link ?>"><p class="fa-brands fa-instagram fa-lg footer-icon"></p></a>
                    <?php endif; ?>
                    <?php if (User::find()->one()->facebook_link): ?>
                        <a href="<?= User::find()->one()->facebook_link ?>"><p class="fa-brands fa-facebook fa-lg footer-icon"></p></a>
                    <?php endif; ?>
                    <?php if (User::find()->one()->twitter_link): ?>
                        <a href="<?= User::find()->one()->twitter_link ?>"><p class="fa-brands fa-twitter fa-lg footer-icon"></p></a>
                    <?php endif; ?>
                    <?php if (User::find()->one()->vk_link): ?>
                        <a href="<?= User::find()->one()->vk_link ?>"><p class="fa-brands fa-vk fa-lg footer-icon"></p></a>
                    <?php endif; ?>
                </div>
                <div class="col-sm-4 text-right"><?= Yii::t('app', 'FOOTER_POWERED_BY') .
                    ' <a href="https://github.com/LedZeppe1in">' . Yii::t('app', 'FOOTER_DEVELOPER') .
                    '</a>' ?>
                </div>
            </div>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>

</html>

<?php $this->endPage() ?>