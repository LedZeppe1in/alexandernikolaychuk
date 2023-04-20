<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<!-- Breadcrumbs Section -->
<section class="breadcrumbs-custom bg-image context-dark" style="background-image: url(/web/images/breadcrumbs-error.jpg);">
    <div class="container">
        <h3 class="breadcrumbs-custom-title"><?= $this->title ?></h3>
    </div>
</section>

<!-- Blurb minimal -->
<section class="section section-md bg-default">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-xl-6">
                <div class="big-title-wrap">
                    <div class="big-title">404</div>
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