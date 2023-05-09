<?php

/* @var $this yii\web\View */
/* @var $user app\modules\admin\models\User */

use yii\bootstrap5\Html;

$this->title = Yii::$app->language == 'ru-RU' ? $user->full_name_ru : $user->full_name_en;
?>

<video autoplay="" muted="" poster="/images/contacts.jpg" id="bgvid" loop="">
    <source src="/video/background.mov" type="video/mp4">
</video>

<div class="container home-container">
    <div class="row home-row">
        <div class="col-md-12 home-col">
            <?php
                if (Yii::$app->language == 'ru-RU')
                    echo Html::img('@web/images/client-logo-ru.png', ['class'=>'client-logo']);
                else
                    echo Html::img('@web/images/client-logo-en.png', ['class'=>'client-logo']);
            ?>
        </div>
    </div>
</div>
