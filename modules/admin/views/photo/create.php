<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Photo $model */

$this->title = Yii::t('app', 'PHOTO_ADMIN_PAGE_CREATE_PHOTO');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'PHOTO_ADMIN_PAGE_PHOTOS'),
    'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="photo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>