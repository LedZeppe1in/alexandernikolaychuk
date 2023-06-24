<?php

use app\modules\admin\models\MusicAlbum;
use yii\bootstrap5\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\MusicAlbum $model */

$this->title = Yii::t('app', 'MUSIC_ADMIN_PAGE_VIEW_MUSIC_ALBUM') . ' - ' . $model->name_ru;

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
            'name_ru',
            'name_en',
            [
                'attribute' => 'type',
                'value' => function($model) {
                    return $model->getTypeName();
                },
                'format' => 'raw',
            ],
            [
                'attribute' => Yii::t('app', 'PROJECT_ALBUM_MODEL_PROJECT'),
                'value' => function($model) {
                    if (Yii::$app->language == 'ru-RU')
                        return $model->projectAlbums ? $model->projectAlbums[0]->musicProject->name_ru : null;
                    else
                        return $model->projectAlbums ? $model->projectAlbums[0]->musicProject->name_en : null;
                },
                'format' => 'raw',
                'visible' => $model->projectAlbums ? true : false,
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
                'attribute' => 'authors_ru',
                'value' => $model->authors_ru !== '' ? $model->authors_ru : null,
                'format' => 'raw'
            ],
            [
                'attribute' => 'authors_en',
                'value' => $model->authors_en !== '' ? $model->authors_en : null,
                'format' => 'raw'
            ],
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
                'label' => Yii::t('app', 'MUSIC_ALBUM_MODEL_COVER_RU'),
                'value' => $model->cover_ru !== null ? Html::img('@web/uploads/album-cover-ru/' .$model->id . '/' .
                    basename($model->cover_ru), ['class' => 'image-block']) : null,
                'format' => 'raw'
            ],
            [
                'label' => Yii::t('app', 'MUSIC_ALBUM_MODEL_COVER_EN'),
                'value' => $model->cover_en !== null ? Html::img('@web/uploads/album-cover-en/' .$model->id . '/' .
                    basename($model->cover_en), ['class' => 'image-block']) : null,
                'format' => 'raw'
            ]
        ]
    ]) ?>

</div>