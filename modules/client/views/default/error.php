<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\admin\models\User;

$this->title = $name;
?>

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
        <?php if (Yii::$app->user->isGuest)
            echo '<li>' . Html::a(Yii::t('app', 'NAV_SIGN_IN'), ['default/sing-in']) . '</li>';
        else
            echo '<li>' . Html::a(Yii::t('app', 'NAV_ADMINISTRATION'), ['/admin/user/profile']) .
                '</li><li>' . Html::a(Yii::t('app', 'NAV_SIGN_OUT'), ['default/sing-out']) .
                '</li>';
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

<div class="error-wrap">
    <!-- Breadcrumbs Section -->
    <section class="breadcrumbs-custom bg-image context-dark">
        <div class="container">
            <h1 class="breadcrumbs-custom-title error-title"><?= $this->title ?></h1>
        </div>
    </section>

    <!-- Blurb minimal -->
    <section class="section section-md bg-default">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-xl-6 well">
                    <div class="big-title-wrap">
                        <h5 class="big-title-text"><?= nl2br(Html::encode($message)) ?></h5>
                    </div>
                    <div class="big-title-wrap">
                        <p class="big"><?= Yii::t('app', 'ERROR_PAGE_NOTICE') ?></p>
                        <p class="big"><?= Yii::t('app', 'ERROR_PAGE_TEXT') ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
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