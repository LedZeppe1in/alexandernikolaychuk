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
                    <a href="<?= Url::to(['default/biography']) ?>">
                        <?= Yii::t('app', 'NAV_BIOGRAPHY') ?>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['default/concerts']) ?>">
                        <?= Yii::t('app', 'NAV_CONCERTS') ?>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['default/media']) ?>">
                        <?= Yii::t('app', 'NAV_MEDIA') ?>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['default/music']) ?>">
                        <?= Yii::t('app', 'NAV_MUSIC') ?>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['default/projects']) ?>">
                        <?= Yii::t('app', 'NAV_PROJECTS') ?>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['default/repertoire']) ?>">
                        <?= Yii::t('app', 'NAV_REPERTOIRE') ?>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['default/contacts']) ?>">
                        <?= Yii::t('app', 'NAV_CONTACTS') ?>
                    </a>
                </li>
                <li>
                    <a href="<?= Yii::$app->user->isGuest ? Url::to(['default/sing-in']) :
                        Url::to(['default/sing-out']) ?>">
                        <?= Yii::$app->user->isGuest ? Yii::t('app', 'NAV_SIGN_IN') :
                            Yii::t('app', 'NAV_SIGN_OUT') . ' (' .
                            Yii::$app->user->identity->username . ')' ?>
                    </a>
                </li>
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
                    <a href="<?= User::find()->one()->youtube_link ?>"><p class="fa-brands fa-youtube fa-lg footer-icon"></p></a>
                    <a href="<?= User::find()->one()->instagram_link ?>"><p class="fa-brands fa-instagram fa-lg footer-icon"></p></a>
                    <a href="<?= User::find()->one()->vk_link ?>"><p class="fa-brands fa-vk fa-lg footer-icon"></p></a>
                </div>
                <div class="col-sm-4 text-right"><?= Yii::t('app', 'FOOTER_POWERED_BY') .
                    ' <a href="https://github.com/LedZeppe1in">' . Yii::t('app', 'FOOTER_DEVELOPER') .
                    '</a>' ?></div>
            </div>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>

</html>

<?php $this->endPage() ?>