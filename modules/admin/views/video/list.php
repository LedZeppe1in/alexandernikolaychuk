<?php

use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\modules\admin\models\Video;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\VideoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'VIDEO_ADMIN_PAGE_VIDEO');

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="video-list">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'VIDEO_ADMIN_PAGE_CREATE_VIDEO'),
            ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'link',
                'format' => 'raw',
                'value' => function($data) {
                    if ($data->link)
                        return Html::a($data->link, $data->link);
                    else
                        return null;
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Video $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

</div>