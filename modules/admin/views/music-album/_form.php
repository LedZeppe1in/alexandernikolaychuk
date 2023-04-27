<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use app\modules\admin\models\MusicAlbum;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\MusicAlbum $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="music-album-form">

    <?php $form = ActiveForm::begin([
        'id' => $model->isNewRecord ? 'create-music-album-form' : 'update-music-album-form',
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList(MusicAlbum::getTypesArray()) ?>

    <?= $form->field($model, 'cover_file')->fileInput() ?>

    <?= $form->field($model, 'links')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'author')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'BUTTON_SAVE') :
            Yii::t('app', 'BUTTON_UPDATE'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>