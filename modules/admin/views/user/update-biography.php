<?php

use yii\bootstrap5\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\User */

$this->title = Yii::t('app', 'USER_ADMIN_PAGE_UPDATE_BIOGRAPHY');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'USER_ADMIN_PAGE_MY_BIOGRAPHY'),
    'url' => ['biography']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="biography-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_update_biography', [
        'model' => $model,
    ]) ?>

</div>