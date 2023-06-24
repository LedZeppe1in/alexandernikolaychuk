<?php

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Concert $model */

use yii\bootstrap5\Html;

$this->title = Yii::t('app', 'CONCERTS_ADMIN_PAGE_UPDATE_CONCERT');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONCERTS_ADMIN_PAGE_CONCERTS'),
    'url' => ['list']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONCERTS_ADMIN_PAGE_CONCERT') . ' - ' .
    $model->name_ru, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="concert-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>