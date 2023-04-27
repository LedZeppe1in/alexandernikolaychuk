<?php

/* @var $model app\modules\admin\models\Video */

use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use yii\bootstrap5\ActiveForm;
?>

<?php Modal::begin([
    'id' => 'removeVideoModalForm',
    'title' => '<h3>' . Yii::t('app', 'VIDEO_ADMIN_PAGE_DELETE_VIDEO') . '</h3>',
]); ?>

    <div class="modal-body">
        <p style="font-size: 14px">
            <?= Yii::t('app', 'VIDEO_ADMIN_PAGE_MODAL_FORM_TEXT'); ?>
        </p>
    </div>

<?php $form = ActiveForm::begin([
    'id' => 'delete-video-form',
    'method' => 'post',
    'action' => ['/video/delete/' . $model->id],
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
]); ?>

    <?= Html::submitButton(Yii::t('app', 'BUTTON_DELETE'),
        ['class' => 'btn btn-danger']) ?>

    <button type="button" class="btn btn-primary" style="margin:5px" data-bs-dismiss="modal">
        <?= Yii::t('app', 'BUTTON_CANCEL'); ?>
    </button>

<?php ActiveForm::end(); ?>

<?php Modal::end(); ?>