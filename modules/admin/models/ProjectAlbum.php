<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%project_album}}".
 *
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property int $project
 * @property int $music_album
 *
 * @property MusicAlbum $musicAlbum
 * @property Project $musicProject
 */
class ProjectAlbum extends \yii\db\ActiveRecord
{
    /**
     * @return string table name
     */
    public static function tableName()
    {
        return '{{%project_album}}';
    }

    /**
     * @return array the validation rules
     */
    public function rules()
    {
        return [
            [['project', 'music_album'], 'required'],
            [['project', 'music_album'], 'default', 'value' => null],
            [['project', 'music_album'], 'integer'],
            [['music_album'], 'exist', 'skipOnError' => true, 'targetClass' => MusicAlbum::class,
                'targetAttribute' => ['music_album' => 'id']],
            [['project'], 'exist', 'skipOnError' => true, 'targetClass' => Project::class,
                'targetAttribute' => ['project' => 'id']],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'PROJECT_ALBUM_MODEL_ID'),
            'created_at' => Yii::t('app', 'PROJECT_ALBUM_MODEL_CREATED_AT'),
            'updated_at' => Yii::t('app', 'PROJECT_ALBUM_MODEL_UPDATED_AT'),
            'project' => Yii::t('app', 'PROJECT_ALBUM_MODEL_PROJECT'),
            'music_album' => Yii::t('app', 'PROJECT_ALBUM_MODEL_MUSIC_ALBUM'),
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * Gets query for [[MusicAlbum]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMusicAlbum()
    {
        return $this->hasOne(MusicAlbum::class, ['id' => 'music_album']);
    }

    /**
     * Gets query for [[MusicProject]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMusicProject()
    {
        return $this->hasOne(Project::class, ['id' => 'project']);
    }
}