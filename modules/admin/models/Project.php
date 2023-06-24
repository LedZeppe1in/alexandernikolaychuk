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
 * @property string $name_ru
 * @property string $name_en
 * @property string|null $description_ru
 * @property string|null $description_en
 * @property string|null $poster
 *
 * @property ProjectAlbum[] $projectAlbums
 * @property ProjectPhoto[] $projectPhotos
 */
class Project extends \yii\db\ActiveRecord
{
    public $poster_file;  // Файл постера

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
            [['name_ru', 'name_en'], 'required'],
            [['description_ru', 'description_en', 'poster'], 'string'],
            [['name_ru', 'name_en'], 'string', 'max' => 255],
            ['poster_file', 'file', 'checkExtensionByMimeType' => false, 'extensions' => ['jpg', 'jpeg', 'png']],
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
            'name_ru' => Yii::t('app', 'PROJECT_MODEL_NAME_RU'),
            'name_en' => Yii::t('app', 'PROJECT_MODEL_NAME_EN'),
            'description_ru' => Yii::t('app', 'PROJECT_MODEL_DESCRIPTION_RU'),
            'description_en' => Yii::t('app', 'PROJECT_MODEL_DESCRIPTION_EN'),
            'poster' => Yii::t('app', 'PROJECT_MODEL_POSTER'),
            'poster_file' => Yii::t('app', 'PROJECT_MODEL_POSTER'),
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