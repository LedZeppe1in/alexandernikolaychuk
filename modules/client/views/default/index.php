<?php

/* @var $this yii\web\View */
/* @var $user app\modules\admin\models\User */

$this->title = Yii::$app->language == 'ru-RU' ? $user->full_name_ru : $user->full_name_en;
?>

<video loop muted autoplay id="bgvid">
    <source src="/video/background.mov" type="video/mp4">
</video>

<div class="container home-container">
    <div class="row home-row">
        <div class="col-md-12 home-col">
            <h1 class="home-heading"><?= Yii::t('app', 'HOME_PAGE_TITLE') ?></h1><br>
            <p class="home-paragraph"><?= Yii::t('app', 'HOME_PAGE_TEXT') ?></p>
        </div>
    </div>
</div>
