<?php

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\MusicAlbum */
/* @var $user app\modules\admin\models\User */
/* @var $id app\modules\client\controllers\DefaultController */

use coderius\swiperslider\SwiperSlider;
use yii\bootstrap5\Html;

$this->title = Yii::t('app', 'MEDIA_PAGE_PHOTO');

$links = [];
foreach ($model as $item)
    if ($item->id == $id)
        array_push($links, Html::img('@web/uploads/photo/' . $item->id . '/' . basename($item->file)));
foreach ($model as $item)
    if ($item->id != $id)
        array_push($links, Html::img('@web/uploads/photo/' . $item->id . '/' . basename($item->file)));
?>

<div class="slider-wrapper">
    <?= Html::a('×', ['photo'], ['class' => 'close']) ?>
    <?= SwiperSlider::widget([
        'slides' => $links,
        'clientOptions' => [
            'spaceBetween'=> 30,
            'pagination' => [
                'clickable' => true,
            ]
        ],
    ]); ?>
</div>