<?php

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Video */
/* @var $user app\modules\admin\models\User */

use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'MEDIA_PAGE_VIDEO');
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
        <?php if (!Yii::$app->user->isGuest)
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

<div class="container videos-container">
    <div class="row">
        <div class="text-center">
            <h1 class="section-header album-title"><?= Yii::t('app', 'MEDIA_PAGE_VIDEO') ?></h1>
        </div>
    </div><br />
    <div class="row" id="videos">
        <?php foreach ($model as $item): ?>
            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 embed-item text-center">
                <div class="embed-responsive embed-responsive-16by9 embed-content">
                    <iframe src="<?= $item->link ?>" class="embed-responsive-item" allowfullscreen="allowfullscreen"></iframe>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div><br /><br />

<footer id="footer" class="footer-home">
    <div class="container footer-container">
        <div class="row footer-row">
            <div class="col-sm-4 text-left">&copy; <?= date('Y') . ' ' .
                Yii::t('app', 'FOOTER_LOGO') ?></div>
            <div class="col-sm-4 text-center">
                <?php if ($user->youtube_link): ?>
                    <a href="<?= $user->youtube_link ?>"><p class="fa-brands fa-youtube fa-lg footer-icon"></p></a>
                <?php endif; ?>
                <?php if ($user->instagram_link): ?>
                    <a href="<?= $user->instagram_link ?>"><p class="fa-brands fa-instagram fa-lg footer-icon"></p></a>
                <?php endif; ?>
                <?php if ($user->facebook_link): ?>
                    <a href="<?= $user->facebook_link ?>"><p class="fa-brands fa-facebook fa-lg footer-icon"></p></a>
                <?php endif; ?>
                <?php if ($user->twitter_link): ?>
                    <a href="<?= $user->twitter_link ?>"><p class="fa-brands fa-twitter fa-lg footer-icon"></p></a>
                <?php endif; ?>
                <?php if ($user->vk_link): ?>
                    <a href="<?= $user->vk_link ?>"><p class="fa-brands fa-vk fa-lg footer-icon"></p></a>
                <?php endif; ?>
            </div>
            <div class="col-sm-4 text-right"><?= Yii::t('app', 'FOOTER_POWERED_BY') .
                ' <a href="https://github.com/LedZeppe1in">' . Yii::t('app', 'FOOTER_DEVELOPER') .
                '</a>' ?>
            </div>
        </div>
    </div>
</footer>