<?php

use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\modules\admin\models\Concert;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\ConcertSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'CONCERTS_ADMIN_PAGE_CONCERTS');

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="concert-list">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'CONCERTS_ADMIN_PAGE_CREATE_CONCERT'),
            ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function($data) {
                    if ($data->name)
                        return $data->name;
                    else
                        return null;
                }
            ],
            [
                'attribute' => 'links',
                'format' => 'raw',
                'value' => function($data) {
                    if ($data->links) {
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
                'attribute' => 'poster',
                'format' => 'raw',
                'value' => function($data) {
                    if ($data->poster)
                        return Html::img('@web/uploads/concert-poster/' . $data->id . '/' . basename($data->poster),
                            ['class' => 'image-td']);
                    else
                        return null;
                },
                'headerOptions' => ['style' => 'width:20%']
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Concert $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
        'pager' => [
            'class' => 'yii\bootstrap5\LinkPager'
        ]
    ]); ?>

</div>