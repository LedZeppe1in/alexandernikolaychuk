<?php

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\MusicAlbum */
/* @var $user app\modules\admin\models\User */

use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'MUSIC_PAGE_TITLE');
?>

<a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars" style="color:"></i></a>
<nav id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle">
            <i class="fa fa-times"></i>
        </a>
        <li class="sidebar-brand">
            <a href="<?= Url::to(['index']) ?>"><?= Yii::t('app', 'NAV_HOME') ?></a>
        </li>
        <li class>
            <a href="<?= Url::to(['biography']) ?>">
                <?= Yii::t('app', 'NAV_BIOGRAPHY') ?>
            </a>
        </li>
        <li class>
            <a href="<?= Url::to(['concerts']) ?>">
                <?= Yii::t('app', 'NAV_CONCERTS') ?>
            </a>
        </li>
        <li class>
            <a href="<?= Url::to(['media']) ?>">
                <?= Yii::t('app', 'NAV_MEDIA') ?>
            </a>
        </li>
        <li class="active">
            <a href="<?= Url::to(['music']) ?>">
                <?= Yii::t('app', 'NAV_MUSIC') ?>
            </a>
        </li>
        <li class>
            <a href="<?= Url::to(['projects']) ?>">
                <?= Yii::t('app', 'NAV_PROJECTS') ?>
            </a>
        </li>
        <li class>
            <a href="<?= Url::to(['repertoire']) ?>">
                <?= Yii::t('app', 'NAV_REPERTOIRE') ?>
            </a>
        </li>
        <li class>
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
                Yii::$app->language == 'ru-RU' ? '/en' . Yii::$app->getRequest()->getLangUrl() : '/ru' .
                    Yii::$app->getRequest()->getLangUrl(), ['class' => 'rd-nav-link']) ?>
        </li>
    </ul>
</nav>

<div class="container cover-container" style="z-index:;">
    <div class="cover" style="background-image: url(/images/music.jpeg); background-position:% 50%;"></div>
    <div class="title-block">
        <div class="row title-row">
            <div class="col-sm-12 title-col">
                <h1 class="header"><?= Yii::t('app', 'MUSIC_PAGE_TITLE') ?><br></h1>
                <div class="angle">
                    <a href="#body" class="btn-scroll">
                        <i class="fa fa-angle-down animated" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container discography content-box" id="body">
    <div class="row">
        <?php foreach ($model as $item): ?>
            <div class="col-sm-10 col-sm-offset-1 disc">
                <div class="row">
                    <?php if ($item->cover !== null): ?>
                        <div class="col-md-6">
                        <?= Html::img('@web/uploads/album-cover/' . $item->id . '/' . basename($item->cover),
                            ['class' => 'img-responsive center-block cover']); ?>
                        </div>
                    <?php endif; ?>
                    <div class="col-md-6 text-center">
                        <h3 class="title"><?= $item->name ?></h3>
                        <hr>
                        <?php if ($item->links): ?>
                            <div class="description">
                                <?php
                                    $links = explode(',', $item->links);
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
                                ?>
                            </div>
                        <?php endif; ?>
                        <br />
                        <?= Html::a(Yii::t('app', 'BUTTON_LEARN_MORE'),
                            ['music-view', 'id' => $item->id],
                            ['class' => 'btn btn-default btn-primary square-button']) ?>
                    </div>
                </div>
                <div class="text-center"></div>
            </div>
        <?php endforeach; ?>
    </div>

    <footer class="footer" style="position: bottom:">
        <div class="container">
            <div class="row">
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
</div>