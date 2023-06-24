<?php

use yii\bootstrap5\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Repertoire $model */

$this->title = Yii::t('app', 'REPERTOIRE_ADMIN_PAGE_VIEW_REPERTOIRE') . ' - ' . $model->name_ru;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'REPERTOIRE_ADMIN_PAGE_REPERTOIRE'),
    'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<?= $this->render('_modal_form', ['model' => $model]); ?>

<div class="repertoire-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'BUTTON_UPDATE'), ['update', 'id' => $model->id],
            ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'BUTTON_DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data-bs-toggle' => 'modal',
            'data-bs-target' => '#removeRepertoireModalForm'
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'dd.MM.Y HH:mm:ss']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'dd.MM.Y HH:mm:ss']
            ],
            'name_ru',
            'name_en',
            [
                'attribute' => 'type',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->getTypeName();
                }
            ],
            [
                'attribute' => 'composition_list_ru',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->composition_list_ru;
                }
            ],
            [
                'attribute' => 'composition_list_en',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->composition_list_en;
                }
            ]
        ]
    ]) ?>

</div>