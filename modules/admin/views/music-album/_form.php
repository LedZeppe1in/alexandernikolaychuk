<?php

use app\modules\admin\models\Project;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use app\modules\admin\models\MusicAlbum;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\MusicAlbum $model */
/** @var yii\widgets\ActiveForm $form */
?>

<script type="text/javascript">
    function checkType(musicAlbumType) {
        let musicAlbumProjects = document.getElementsByClassName("field-musicalbum-project");
        if (musicAlbumType.value == 0)
            for (let i = 0; i < musicAlbumProjects.length; i++)
                musicAlbumProjects[i].style.display = "none";
        if (musicAlbumType.value == 1)
            for (let i = 0; i < musicAlbumProjects.length; i++)
                musicAlbumProjects[i].style.display = "block";
    }

    $(document).ready(function() {
        let musicAlbumType = document.getElementById("musicalbum-type");
        let musicAlbumProject = document.getElementById("musicalbum-project");
        let modelId = "<?php echo $model->id ?>";

        if (modelId !== "")
            musicAlbumProject.value = "<?= $model->projectAlbums ? $model->projectAlbums[0]->project : null ?>";
            if (musicAlbumProject.value === "")
                musicAlbumProject.selectedIndex = 0
        checkType(musicAlbumType)

        $("#musicalbum-type").change(function() {
            checkType(musicAlbumType)
        });
    });
</script>

<div class="music-album-form">

    <?php $form = ActiveForm::begin([
        'id' => $model->isNewRecord ? 'create-music-album-form' : 'update-music-album-form',
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList(MusicAlbum::getTypesArray()) ?>

    <?= $form->field($model, 'project')->dropDownList(ArrayHelper::map(Project::find()->all(), 'id', 'name')) ?>

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