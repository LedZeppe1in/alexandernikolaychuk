<?php

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Project */
/* @var $user app\modules\admin\models\User */

use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'PROJECT_PAGE_TITLE');
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
<div class="home-header"></div><br /><br />

<div class="container">
    <div class="row">
        <div class="text-center">
            <h1 class="section-header"><?= $model->name ?></h1>
        </div>
    </div><br />
    <div class="row">
        <?php if ($model->poster !== null): ?>
            <div class="col-sm-6">
                <?= Html::img('@web/uploads/project-poster/' . $model->id . '/' . basename($model->poster),
                    ['class' => 'img-responsive center-block']); ?>
            </div>
        <?php endif; ?>
        <div class="col-sm-6">
            <h3><?= Yii::t('app', 'PROJECT_MODEL_DESCRIPTION') ?></h3>
            <div class="description">
                <?php
                    if ($model->description)
                        echo $model->description;
                ?>
            </div>
        </div>
    </div>
    <?php if ($model->projectAlbums): ?>
        <div class="row">
            <div class="text-center">
                <h1 class="section-header"><?= Yii::t('app', 'PROJECTS_PAGE_MUSIC_ALBUM') ?></h1>
            </div>
        </div><br />
        <?php foreach ($model->projectAlbums as $item): ?>
            <div class="col-sm-10 col-sm-offset-1 disc">
                <div class="row">
                    <?php if ($item->musicAlbum->cover !== null): ?>
                        <div class="col-md-6">
                            <?= Html::img('@web/uploads/album-cover/' . $item->musicAlbum->id . '/' .
                                basename($item->musicAlbum->cover), ['class' => 'img-responsive center-block cover']); ?>
                        </div>
                    <?php endif; ?>
                    <div class="col-md-6 text-center">
                        <h3 class="title"><?= $item->musicAlbum->name ?></h3>
                        <hr>
                        <?php if ($item->musicAlbum->links): ?>
                            <div class="description">
                                <?php
                                $links = explode(',', $item->musicAlbum->links);
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
                                    if (!$defined)
                                        $str .= Html::a('<p class="fa-solid fa-music fa-2xl"></p>', $link);
                                }
                                echo $str;
                                ?>
                            </div>
                        <?php endif; ?>
                        <br />
                        <?= Html::a(Yii::t('app', 'BUTTON_LEARN_MORE'),
                            ['music-view', 'id' => $item->musicAlbum->id],
                            ['class' => 'btn btn-default btn-primary square-button']) ?>
                    </div>
                </div>
                <div class="text-center"></div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if ($model->projectPhotos): ?>
        <div class="row">
            <div class="text-center">
                <h1 class="section-header"><?= Yii::t('app', 'PROJECTS_PAGE_PHOTO') ?></h1>
            </div>
        </div><br />
        <?php foreach ($model->projectPhotos as $item): ?>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="album-link" href="<?= Url::to(['/photo-carousel/' . $item->photo]) ?>">
                    <div class="album-hover">
                        <div class="album-hover-content">
                            <i class="fa fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <?= Html::img('@web/uploads/photo/' . $item->projectPhoto->id . '/' .
                        basename($item->projectPhoto->file), ['class' => 'img-responsive tile-photo']); ?>
                </a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
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