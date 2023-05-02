<?php

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Concert */
/* @var $user app\modules\admin\models\User */

use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'CONCERTS_PAGE_TITLE');
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
        <li class="active">
            <a href="<?= Url::to(['concerts']) ?>">
                <?= Yii::t('app', 'NAV_CONCERTS') ?>
            </a>
        </li>
        <li class>
            <a href="<?= Url::to(['media']) ?>">
                <?= Yii::t('app', 'NAV_MEDIA') ?>
            </a>
        </li>
        <li class>
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
        <?php if (Yii::$app->user->isGuest)
            echo '<li>' . Html::a(Yii::t('app', 'NAV_SIGN_IN'), ['sing-in']) . '</li>';
        else
            echo '<li>' . Html::a(Yii::t('app', 'NAV_ADMINISTRATION'), ['/admin/user/profile']) .
                '</li><li>' . Html::a(Yii::t('app', 'NAV_SIGN_OUT'), ['sing-out']) . '</li>';
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
    <div class="cover" style="background-image: url(/images/concert.jpeg); background-position:% 50%;"></div>
    <div class="title-block">
        <div class="row title-row">
            <div class="col-sm-12 title-col">
                <h1 class="header"><?= Yii::t('app', 'CONCERTS_PAGE_TITLE') ?><br></h1>
                <div class="angle">
                    <a href="#body" class="btn-scroll">
                        <i class="fa fa-angle-down animated" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container concerts content-box" id="body">
    <div class="concerts-board">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1" id="concert-items">
                <div class="text-center">
                    <h1 class="section-header upcoming-header">
                        <?= Yii::t('app', 'CONCERT_MODEL_POSTER') ?>
                    </h1>
                    <hr>
                </div>
                <?php foreach ($model as $item): ?>
                    <div class="row concert-item">
                        <div class="col-sm-12 details-block">
                            <?php if ($item->poster !== null): ?>
                                <?= Html::img('@web/uploads/concert-poster/' . $item->id . '/' . basename($item->poster),
                                    ['class' => 'img-responsive center-block post-cover']); ?>
                            <?php endif; ?>
                            <?php if ($item->name): ?>
                                <h3 class="post-title"><?= $item->name ?></h3>
                            <?php endif; ?>
                            <?php
                                if ($item->links) {
                                    $links = explode(',', $item->links);
                                    $str = '';
                                    foreach($links as $link)
                                        $str .= Html::a($link, $link) . '<br />';
                                    echo $str;
                                };
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="text-center"></div>
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