<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Photo $model */

$this->title = Yii::t('app', 'PHOTO_ADMIN_PAGE_UPDATE_PHOTO');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'PHOTO_ADMIN_PAGE_PHOTOS'),
    'url' => ['list']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'PHOTO_ADMIN_PAGE_PHOTO') . ' - ' .
    $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="photo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>