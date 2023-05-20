<?php

/* @var $this yii\web\View */
/* @var $user app\modules\admin\models\User */
/* @var $model app\modules\client\controllers\DefaultController */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;
use yii\helpers\Url;

$this->title = Yii::t('app', 'CONTACTS_PAGE_TITLE');
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
        <li class="active">
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
    <div class="cover" style="background-image: url(/images/contacts.jpg); background-position:% 50%;"></div>
    <div class="title-block">
        <div class="row title-row">
            <div class="col-sm-12 title-col">
                <h1 class="header"><?= Yii::t('app', 'CONTACTS_PAGE_TITLE') ?><br></h1>
                <div class="angle">
                    <a href="#body" class="btn-scroll">
                        <i class="fa fa-angle-down animated" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container contact content-box" id="body">
    <div class="row contact-row">
        <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 contact-col">
            <p class="contact-subheader"><b><?= Yii::t('app', 'CONTACTS_PAGE_NAME') ?></b></p>

            <p class="contact-subheader"><b><?= Yii::t('app', 'CONTACTS_PAGE_SOCIALS') ?></b></p>
            <p class="contact-info">
                <ul class="list-inline list-inline-sm">
                    <?php if ($user->youtube_link): ?>
                        <li><a href="<?= $user->youtube_link ?>"><i class="fa-brands fa-youtube fa-2xl"></i></a></li>
                    <?php endif; ?>
                    <?php if ($user->instagram_link): ?>
                        <li><a href="<?= $user->instagram_link ?>"><i class="fa-brands fa-instagram fa-2xl"></i></a></li>
                    <?php endif; ?>
                    <?php if ($user->facebook_link): ?>
                        <li><a href="<?= $user->facebook_link ?>"><i class="fa-brands fa-facebook fa-2xl"></i></a></li>
                    <?php endif; ?>
                    <?php if ($user->twitter_link): ?>
                        <li><a href="<?= $user->twitter_link ?>"><i class="fa-brands fa-twitter fa-2xl"></i></a></li>
                    <?php endif; ?>
                    <?php if ($user->vk_link): ?>
                        <li><a href="<?= $user->vk_link ?>"><i class="fa-brands fa-vk fa-2xl"></i></a></li>
                    <?php endif; ?>
                    <?php if ($user->apple_music_link): ?>
                        <li><a href="<?= $user->apple_music_link ?>"><i class="fa-brands fa-apple fa-2xl"></i></a></li>
                    <?php endif; ?>
                    <?php if ($user->yandex_music_link): ?>
                        <li><a href="<?= $user->yandex_music_link ?>"><i class="fa-brands fa-yandex fa-2xl"></i></a></li>
                    <?php endif; ?>
                    <?php if ($user->spotify_link): ?>
                        <li><a href="<?= $user->spotify_link ?>"><i class="fa-brands fa-spotify fa-2xl"></i></a></li>
                    <?php endif; ?>
                </ul>
            </p>

            <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

                <div class="alert alert-success">
                    <?= Yii::t('app', 'CONTACTS_PAGE_SUCCESS_MESSAGE') ?>
                </div>

            <?php else: ?>
                <p class="contact-subheader"><b><?= Yii::t('app', 'CONTACTS_PAGE_TOUCH_WITH_ME') ?></b></p>
                <p class="contact-info"><?= Yii::t('app', 'CONTACTS_PAGE_NOTICE') ?><br /><br />

                <?php $form = ActiveForm::begin([
                    'id' => 'contact-form',
                    'options' => [
                        'class' => 'rd-form form-boxed',
                    ]
                ]); ?>
                    <div class="row row-50">
                        <div class="col-lg-4">
                            <div class="form-wrap form-wrap-icon">
                                <div class="form-icon mdi mdi-account-outline"></div>
                                <?= $form->field($model, 'name')->textInput(['class' => 'form-input'])->label(false) ?>
                                <label class="form-label rd-input-label" for="contactform-name">
                                    <?= Yii::t('app', 'CONTACT_FORM_NAME') ?>
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-wrap form-wrap-icon">
                                <div class="form-icon mdi mdi-email-outline"></div>
                                <?= $form->field($model, 'email')->textInput(['class' => 'form-input'])->label(false) ?>
                                <label class="form-label rd-input-label" for="contactform-email">
                                    <?= Yii::t('app', 'CONTACT_FORM_EMAIL') ?>
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-wrap form-wrap-icon">
                                <div class="form-icon mdi mdi-information-outline"></div>
                                <?= $form->field($model, 'subject')->textInput(['class' => 'form-input'])->label(false) ?>
                                <label class="form-label rd-input-label" for="contactform-subject">
                                    <?= Yii::t('app', 'CONTACT_FORM_SUBJECT') ?>
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-wrap form-wrap-icon">
                                <div class="form-icon mdi mdi-message-outline"></div>
                                <label class="form-label rd-input-label" for="contactform-body">
                                    <?= Yii::t('app', 'CONTACT_FORM_MESSAGE') ?>
                                </label>
                                <?= $form->field($model, 'body')
                                    ->textarea(['class' => 'form-input form-control-last-child', 'rows' => 1])
                                    ->label(false) ?>
                            </div>
                        </div>

                        <div class="col-12">
                            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                                'captchaAction' => '/client/default/captcha',
                                'template' => '<div class="col-lg-2">{image}</div>
                                    <div class="col-lg-4">
                                        <div class="form-wrap form-wrap-icon">
                                            <div class="form-icon mdi mdi-code-string"></div>
                                            {input}
                                            <label class="form-label rd-input-label" for="contactform-verifycode">' .
                                            Yii::t('app', 'CONTACT_FORM_VERIFICATION_CODE'). '</label>
                                        </div>
                                    </div>',
                                'options' => ['class' => 'form-input'],
                            ])->label(false) ?>
                        </div>

                        <div class="col-md-12">
                            <?= Html::submitButton(Yii::t('app', 'BUTTON_SEND'), [
                                'class' => 'button button-default',
                                'name' => 'contact-button'
                            ]) ?>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
                </p>
            <?php endif; ?>
        </div>
    </div>

    <footer class="footer" style="position:absolute; bottom:0">
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