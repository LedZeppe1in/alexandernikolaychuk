<?php

use yii\bootstrap5\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Photo $model */

$this->title = Yii::t('app', 'PHOTO_ADMIN_PAGE_VIEW_PHOTO') . ' - ' . $model->id;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'PHOTO_ADMIN_PAGE_PHOTOS'),
    'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<?= $this->render('_modal_form', ['model' => $model]); ?>

<div class="photo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'BUTTON_UPDATE'), ['update', 'id' => $model->id],
            ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'BUTTON_DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data-bs-toggle' => 'modal',
            'data-bs-target' => '#removePhotoModalForm'
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
            [
                'attribute' => 'type',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->getTypeName();
                }
            ],
            [
                'attribute' => Yii::t('app', 'PROJECT_PHOTO_MODEL_PROJECT'),
                'value' => function($model) {
                    return $model->projectPhotos ? $model->projectPhotos[0]->musicProject->name : null;
                },
                'format' => 'raw',
                'visible' => $model->projectPhotos ? true : false,
            ],
            [
                'label' => Yii::t('app', 'PHOTO_MODEL_FILE'),
                'value' => $model->file !== null ? Html::img('@web/uploads/photo/' .$model->id . '/' .
                    basename($model->file), ['class' => 'image-block']) : null,
                'format' => 'raw'
            ]
        ]
    ]) ?>

</div>