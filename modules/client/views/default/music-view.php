<?php

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\MusicAlbum */
/* @var $user app\modules\admin\models\User */

use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'MUSIC_PAGE_TITLE');
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
<div class="home-header"></div><br /><br />

<div class="container">
    <div class="row">
        <div class="text-center">
            <h1 class="section-header">
                <?php
                    if (Yii::$app->language == 'ru-RU')
                        echo $model->name_ru;
                    else
                        echo $model->name_en;
                ?>
            </h1>
        </div>
    </div><br />
    <div class="row">
        <?php if (Yii::$app->language == 'ru-RU'): ?>
            <?php if ($model->cover_ru !== null): ?>
                <div class="col-sm-6">
                    <?= Html::img('@web/uploads/album-cover-ru/' . $model->id . '/' . basename($model->cover_ru),
                        ['class' => 'img-responsive center-block']); ?>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <?php if ($model->cover_en !== null): ?>
                <div class="col-sm-6">
                    <?= Html::img('@web/uploads/album-cover-en/' . $model->id . '/' . basename($model->cover_en),
                        ['class' => 'img-responsive center-block']); ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <div class="col-sm-6">
            <div class="description">
                <?php if ($model->links) {
                    $links = explode(',', $model->links);
                    $str = '';
                    foreach($links as $link) {
                        $defined = false;
                        if ($str != '')
                            $str .= ' • ';
                        $pos = strripos($link, 'apple');
                        if ($pos !== false) {
                            $defined = true;
                            $str .= Html::a('<p class="fa-brands fa-apple fa-2xl"></p>', $link);
                        }
                        $pos = strripos($link, 'yandex');
                        if ($pos !== false) {
                            $defined = true;
                            $str .= Html::a('<p class="fa-brands fa-yandex fa-2xl"></p>', $link);
                        }
                        $pos = strripos($link, 'spotify');
                        if ($pos !== false) {
                            $defined = true;
                            $str .= Html::a('<p class="fa-brands fa-spotify fa-2xl"></p>', $link);
                        }
                        $pos = strripos($link, 'vk.com');
                        if ($pos !== false) {
                            $defined = true;
                            $str .= Html::a('<p class="fa-brands fa-vk fa-2xl"></p>', $link);
                        }
                        if (!$defined)
                            $str .= Html::a('<p class="fa-solid fa-music fa-2xl"></p>', $link);
                    }
                    echo $str;
                } ?>
            </div><br />
            <div class="description music-description">
                <?php
                    if (Yii::$app->language == 'ru-RU')
                        if ($model->description_ru)
                            echo $model->description_ru;
                    else
                        if ($model->description_en)
                            echo $model->description_en;
                ?>
            </div>
        </div>
    </div>
</div><br /><br /><br />

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