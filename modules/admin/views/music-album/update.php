<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\MusicAlbum $model */

$this->title = Yii::t('app', 'MUSIC_ADMIN_PAGE_UPDATE_MUSIC_ALBUM');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'MUSIC_ADMIN_PAGE_MUSIC_ALBUMS'),
    'url' => ['list']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'MUSIC_ADMIN_PAGE_MUSIC_ALBUM') . ' - ' .
    $model->name_ru, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="music-album-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>