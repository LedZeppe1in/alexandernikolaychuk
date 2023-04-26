<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Concert $model */

$this->title = Yii::t('app', 'CONCERTS_ADMIN_PAGE_CREATE_CONCERT');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONCERTS_ADMIN_PAGE_CONCERTS'),
    'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="concert-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>