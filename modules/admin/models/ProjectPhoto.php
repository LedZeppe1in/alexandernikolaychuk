<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%project_photo}}".
 *
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property int $project
 * @property int $photo
 *
 * @property Photo $projectPhoto
 * @property Project $musicProject
 */
class ProjectPhoto extends \yii\db\ActiveRecord
{
    /**
     * @return string table name
     */
    public static function tableName()
    {
        return '{{%project_photo}}';
    }

    /**
     * @return array the validation rules
     */
    public function rules()
    {
        return [
            [['project', 'photo'], 'required'],
            [['project', 'photo'], 'default', 'value' => null],
            [['project', 'photo'], 'integer'],
            [['photo'], 'exist', 'skipOnError' => true, 'targetClass' => Photo::class,
                'targetAttribute' => ['photo' => 'id']],
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
            'id' => Yii::t('app', 'PROJECT_PHOTO_MODEL_ID'),
            'created_at' => Yii::t('app', 'PROJECT_PHOTO_MODEL_CREATED_AT'),
            'updated_at' => Yii::t('app', 'PROJECT_PHOTO_MODEL_UPDATED_AT'),
            'project' => Yii::t('app', 'PROJECT_PHOTO_MODEL_PROJECT'),
            'photo' => Yii::t('app', 'PROJECT_PHOTO_MODEL_PHOTO'),
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * Gets query for [[ProjectPhoto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjectPhoto()
    {
        return $this->hasOne(Photo::class, ['id' => 'photo']);
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