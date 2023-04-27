<?php

use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\modules\admin\models\MusicAlbum;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\MusicAlbumSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'MUSIC_ADMIN_PAGE_MUSIC_ALBUMS');

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="music-album-list">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'MUSIC_ADMIN_PAGE_CREATE_MUSIC_ALBUM'),
            ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute'=>'type',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->getTypeName();
                },
                'filter'=>MusicAlbum::getTypesArray(),
                'filterInputOptions' => ['class' => 'form-select']
            ],
            [
                'attribute' => 'author',
                'format' => 'raw',
                'value' => function($data) {
                    if ($data->author)
                        return $data->author;
                    else
                        return null;
                }
            ],
            [
                'attribute' => 'links',
                'format' => 'raw',
                'value' => function($data) {
                    if ($data->name) {
                        $links = explode(',', $data->links);
                        $str = '';
                        foreach($links as $link)
                            $str .= Html::a($link, $link) . '<br />';
                        return $str;
                    } else
                        return null;
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, MusicAlbum $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

</div>