<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\Tabs;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\User */

$this->title = Yii::t('app', 'USER_ADMIN_PAGE_MY_BIOGRAPHY');

$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="account-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'USER_ADMIN_PAGE_BUTTON_UPDATE_BIOGRAPHY'), ['update-biography'],
            ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo Tabs::widget([
        'items' => [
            [
                'label' => Yii::t('app', 'USER_MODEL_BIOGRAPHY_RU'),
                'content' =>  $model->biography_ru ? '<div class="well">' . $model->biography_ru . '</div>' :
                    '<div class="well">' . Yii::t('app', 'GENERAL_NOTICE_NO_RESULTS_FOUND') . '</div>',
                'active' => true
            ],
            [
                'label' => Yii::t('app', 'USER_MODEL_BIOGRAPHY_EN'),
                'content' =>  $model->biography_en ? '<div class="well">' . $model->biography_en . '</div>' :
                    '<div class="well">' . Yii::t('app', 'GENERAL_NOTICE_NO_RESULTS_FOUND') . '</div>',
            ]
        ]
    ]); ?>

</div>