<?php

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Concert $model */

use yii\bootstrap5\Html;
use yii\widgets\DetailView;

$this->title = Yii::t('app', 'CONCERTS_ADMIN_PAGE_VIEW_CONCERT') . ' - ' . $model->name;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONCERTS_ADMIN_PAGE_CONCERTS'),
    'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<?= $this->render('_modal_form', ['model' => $model]); ?>

<div class="concert-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'BUTTON_UPDATE'), ['update', 'id' => $model->id],
            ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'BUTTON_DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data-bs-toggle' => 'modal',
            'data-bs-target' => '#removeConcertModalForm'
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
                'attribute' => 'name',
                'value' => $model->name !== '' ? $model->name : null,
                'format' => 'raw'
            ],
            [
                'attribute' => 'links',
                'value' => function($model) {
                    if ($model->name) {
                        $links = explode(',', $model->links);
                        $str = '';
                        foreach($links as $link)
                            $str .= Html::a($link, $link) . '<br />';
                        return $str;
                    } else
                        return null;
                },
                'format' => 'raw'
            ],
            [
                'label' => Yii::t('app', 'CONCERT_MODEL_POSTER'),
                'value' => $model->poster !== null ? Html::img('@web/uploads/concert-poster/' .$model->id . '/' .
                    basename($model->poster), ['class' => 'image-block']) : null,
                'format' => 'raw'
            ]
        ]
    ]) ?>

</div>