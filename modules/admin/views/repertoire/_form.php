<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use app\modules\admin\models\Repertoire;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Repertoire $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="repertoire-form">

    <?php $form = ActiveForm::begin([
        'id' => $model->isNewRecord ? 'create-repertoire-form' : 'update-repertoire-form',
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList(Repertoire::getTypesArray()) ?>

    <?= $form->field($model, 'composition_list_ru')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full'
    ]) ?>

    <?= $form->field($model, 'composition_list_en')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'BUTTON_SAVE') :
            Yii::t('app', 'BUTTON_UPDATE'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>