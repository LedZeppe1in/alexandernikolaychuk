<?php

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Repertoire $model */

use yii\bootstrap5\Html;

$this->title = Yii::t('app', 'REPERTOIRE_ADMIN_PAGE_UPDATE_REPERTOIRE');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REPERTOIRE_ADMIN_PAGE_REPERTOIRE'),
    'url' => ['list']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REPERTOIRE_ADMIN_PAGE_REPERTOIRE') . ' - ' .
    $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="repertoire-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>