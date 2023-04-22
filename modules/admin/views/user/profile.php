<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\User */

$this->title = Yii::t('app', 'USER_ADMIN_PAGE_MY_PROFILE');

$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="account-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'USER_ADMIN_PAGE_BUTTON_UPDATE_DATA'), ['update-profile'],
            ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'USER_ADMIN_PAGE_BUTTON_UPDATE_PASSWORD'),
                ['update-password'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'created_at',
                'format' => ['date', 'dd.MM.Y HH:mm']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'dd.MM.Y HH:mm']
            ],
            'username',
            'full_name_ru',
            'full_name_en',
            'address_ru',
            'address_en',
            'email:email',
            'phone',
            $model->youtube_link == null ? 'youtube_link' : ([
                'label' => Yii::t('app', 'USER_MODEL_YOUTUBE_LINK'),
                'value' => Html::a($model->youtube_link, $model->youtube_link),
                'format' => 'raw'
            ]),
            $model->instagram_link == null ? 'instagram_link' : ([
                'label' => Yii::t('app', 'USER_MODEL_INSTAGRAM_LINK'),
                'value' => Html::a($model->instagram_link, $model->instagram_link),
                'format' => 'raw'
            ]),
            $model->facebook_link == null ? 'facebook_link' : ([
                'label' => Yii::t('app', 'USER_MODEL_FACEBOOK_LINK'),
                'value' => Html::a($model->facebook_link, $model->facebook_link),
                'format' => 'raw'
            ]),
            $model->twitter_link == null ? 'twitter_link' : ([
                'label' => Yii::t('app', 'USER_MODEL_TWITTER_LINK'),
                'value' => Html::a($model->twitter_link, $model->twitter_link),
                'format' => 'raw'
            ]),
            $model->vk_link == null ? 'vk_link' : ([
                'label' => Yii::t('app', 'USER_MODEL_VK_LINK'),
                'value' => Html::a($model->vk_link, $model->vk_link),
                'format' => 'raw'
            ]),
            $model->apple_music_link == null ? 'apple_music_link' : ([
                'label' => Yii::t('app', 'USER_MODEL_APPLE_MUSIC_LINK'),
                'value' => Html::a($model->apple_music_link, $model->apple_music_link),
                'format' => 'raw'
            ]),
            $model->yandex_music_link == null ? 'yandex_music_link' : ([
                'label' => Yii::t('app', 'USER_MODEL_YANDEX_MUSIC_LINK'),
                'value' => Html::a($model->yandex_music_link, $model->yandex_music_link),
                'format' => 'raw'
            ]),
            $model->spotify_link == null ? 'spotify_link' : ([
                'label' => Yii::t('app', 'USER_MODEL_SPOTIFY_LINK'),
                'value' =>  Html::a($model->spotify_link, $model->spotify_link),
                'format' => 'raw'
            ])
        ]
    ]) ?>

</div>