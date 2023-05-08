<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\modules\admin\models\Photo;
use app\modules\admin\models\Project;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Photo $model */
/** @var yii\widgets\ActiveForm $form */
?>

<script type="text/javascript">
    function checkType(photoType) {
        let photoProjects = document.getElementsByClassName("field-photo-project");
        if (photoType.value == 0)
            for (let i = 0; i < photoProjects.length; i++)
                photoProjects[i].style.display = "none";
        if (photoType.value == 1)
            for (let i = 0; i < photoProjects.length; i++)
                photoProjects[i].style.display = "block";
    }

    $(document).ready(function() {
        let photoType = document.getElementById("photo-type");
        let photoProject = document.getElementById("photo-project");
        let modelId = "<?php echo $model->id ?>";

        if (modelId !== "")
            photoProject.value = "<?= $model->projectPhotos ? $model->projectPhotos[0]->project : null ?>";
            if (photoProject.value === "")
                photoProject.selectedIndex = 0
        checkType(photoType)

        $("#photo-type").change(function() {
            checkType(photoType)
        });
    });
</script>

<div class="photo-form">

    <?php $form = ActiveForm::begin([
        'id' => $model->isNewRecord ? 'create-photo-form' : 'update-photo-form',
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'type')->dropDownList(Photo::getTypesArray()) ?>

    <?= $form->field($model, 'project')->dropDownList(ArrayHelper::map(Project::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'photo_file')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'BUTTON_SAVE') :
            Yii::t('app', 'BUTTON_UPDATE'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>