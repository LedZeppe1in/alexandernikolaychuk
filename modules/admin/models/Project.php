<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%project}}".
 *
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property string $name
 * @property string|null $description
 * @property string|null $poster
 *
 * @property ProjectAlbum[] $projectAlbums
 * @property ProjectPhoto[] $projectPhotos
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @return string table name
     */
    public static function tableName()
    {
        return '{{%project}}';
    }

    /**
     * @return array the validation rules
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description', 'poster'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'PROJECT_MODEL_ID'),
            'created_at' => Yii::t('app', 'PROJECT_MODEL_CREATED_AT'),
            'updated_at' => Yii::t('app', 'PROJECT_MODEL_UPDATED_AT'),
            'name' => Yii::t('app', 'PROJECT_MODEL_NAME'),
            'description' => Yii::t('app', 'PROJECT_MODEL_DESCRIPTION'),
            'poster' => Yii::t('app', 'PROJECT_MODEL_POSTER'),
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * Gets query for [[ProjectAlbums]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjectAlbums()
    {
        return $this->hasMany(ProjectAlbum::class, ['project' => 'id']);
    }

    /**
     * Gets query for [[ProjectPhotos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjectPhotos()
    {
        return $this->hasMany(ProjectPhoto::class, ['project' => 'id']);
    }
}