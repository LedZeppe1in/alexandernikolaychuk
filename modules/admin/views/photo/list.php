<?php

use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\modules\admin\models\Photo;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\PhotoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'PHOTO_ADMIN_PAGE_PHOTOS');

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="photo-list">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'PHOTO_ADMIN_PAGE_CREATE_PHOTO'),
            ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'type',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->getTypeName();
                },
                'filter'=>Photo::getTypesArray(),
                'filterInputOptions' => ['class' => 'form-select']
            ],
            [
                'attribute' => 'file',
                'format' => 'raw',
                'value' => function($data) {
                    if ($data->file)
                        return Html::img('@web/uploads/photo/' . $data->id . '/' . basename($data->file),
                            ['class' => 'image-td']);
                    else
                        return null;
                },
                'headerOptions' => ['style' => 'width:20%']
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Photo $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

</div>