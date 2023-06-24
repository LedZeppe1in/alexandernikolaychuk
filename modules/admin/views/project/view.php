<?php

use yii\bootstrap5\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Project $model */

$this->title = Yii::t('app', 'PROJECTS_ADMIN_PAGE_VIEW_PROJECT') . ' - ' . $model->name_ru;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'PROJECTS_ADMIN_PAGE_PROJECTS'),
    'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<?= $this->render('_modal_form', ['model' => $model]); ?>

<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'BUTTON_UPDATE'), ['update', 'id' => $model->id],
            ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'BUTTON_DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data-bs-toggle' => 'modal',
            'data-bs-target' => '#removeProjectModalForm'
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
                'attribute' => 'description_ru',
                'value' => $model->description_ru !== '' ? $model->description_ru : null,
                'format' => 'raw'
            ],
            [
                'attribute' => 'description_en',
                'value' => $model->description_en !== '' ? $model->description_en : null,
                'format' => 'raw'
            ],
            [
                'label' => Yii::t('app', 'PROJECT_MODEL_POSTER'),
                'value' => $model->poster !== null ? Html::img('@web/uploads/project-poster/' .$model->id . '/' .
                    basename($model->poster), ['class' => 'image-block']) : null,
                'format' => 'raw'
            ]
        ]
    ]) ?>

</div>