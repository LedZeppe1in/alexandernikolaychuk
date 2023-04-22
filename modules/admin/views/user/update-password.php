<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\User */

$this->title = Yii::t('app', 'USER_ADMIN_PAGE_UPDATE_PASSWORD');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'USER_ADMIN_PAGE_MY_PROFILE'),
    'url' => ['profile']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="password-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_update_password', [
        'model' => $model,
    ]) ?>

</div>