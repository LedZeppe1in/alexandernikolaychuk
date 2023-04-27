<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\modules\admin\models\Photo;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Photo $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="photo-form">

    <?php $form = ActiveForm::begin([
        'id' => $model->isNewRecord ? 'create-photo-form' : 'update-photo-form',
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'type')->dropDownList(Photo::getTypesArray()) ?>

    <?= $form->field($model, 'photo_file')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'BUTTON_SAVE') :
            Yii::t('app', 'BUTTON_UPDATE'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>