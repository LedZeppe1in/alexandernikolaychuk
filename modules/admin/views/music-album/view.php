<?php

use yii\bootstrap5\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\MusicAlbum $model */

$this->title = Yii::t('app', 'MUSIC_ADMIN_PAGE_VIEW_MUSIC_ALBUM') . ' - ' . $model->name;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'MUSIC_ADMIN_PAGE_MUSIC_ALBUMS'),
    'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<?= $this->render('_modal_form', ['model' => $model]); ?>

<div class="music-album-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'BUTTON_UPDATE'), ['update', 'id' => $model->id],
            ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'BUTTON_DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data-bs-toggle' => 'modal',
            'data-bs-target' => '#removeMusicAlbumModalForm'
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
            'name',
            [
                'attribute' => 'type',
                'value' => function($model) {
                    return $model->getTypeName();
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'links',
                'value' => function($model) {
                    if ($model->links) {
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
                'attribute' => 'author',
                'value' => $model->author !== '' ? $model->author : null,
                'format' => 'raw'
            ],
            [
                'attribute' => 'description',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->description;
                }
            ],
            [
                'label' => Yii::t('app', 'MUSIC_ALBUM_MODEL_COVER'),
                'value' => $model->cover !== null ? Html::img('@web/uploads/album-cover/' .$model->id . '/' .
                    basename($model->cover), ['class' => 'image-block']) : null,
                'format' => 'raw'
            ]
        ]
    ]) ?>

</div>