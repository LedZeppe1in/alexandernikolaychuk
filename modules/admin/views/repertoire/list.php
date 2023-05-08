<?php

use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\modules\admin\models\Repertoire;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\RepertoireSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'REPERTOIRE_ADMIN_PAGE_REPERTOIRE');

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="repertoire-list">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'REPERTOIRE_ADMIN_PAGE_CREATE_REPERTOIRE'),
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
                'filter'=>Repertoire::getTypesArray(),
                'filterInputOptions' => ['class' => 'form-select']
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Repertoire $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
        'pager' => [
            'class' => 'yii\bootstrap5\LinkPager'
        ]
    ]); ?>

</div>