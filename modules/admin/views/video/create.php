<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Video $model */

$this->title = Yii::t('app', 'VIDEO_ADMIN_PAGE_CREATE_VIDEO');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'VIDEO_ADMIN_PAGE_VIDEO'),
    'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="video-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>