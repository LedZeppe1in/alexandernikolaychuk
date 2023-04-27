<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Repertoire $model */

$this->title = Yii::t('app', 'REPERTOIRE_ADMIN_PAGE_CREATE_REPERTOIRE');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REPERTOIRE_ADMIN_PAGE_REPERTOIRE'),
    'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="repertoire-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>