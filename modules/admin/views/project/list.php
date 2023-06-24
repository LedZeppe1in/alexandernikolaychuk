<?php

use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\modules\admin\models\Project;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\ProjectSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'PROJECTS_ADMIN_PAGE_PROJECTS');

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="project-list">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'PROJECTS_ADMIN_PAGE_CREATE_PROJECT'),
            ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name_ru',
            [
                'attribute' => 'poster',
                'format' => 'raw',
                'value' => function($data) {
                    if ($data->poster)
                        return Html::img('@web/uploads/project-poster/' . $data->id . '/' . basename($data->poster),
                            ['class' => 'image-td']);
                    else
                        return null;
                },
                'headerOptions' => ['style' => 'width:20%']
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Project $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
        'pager' => [
            'class' => 'yii\bootstrap5\LinkPager'
        ]
    ]); ?>

</div>