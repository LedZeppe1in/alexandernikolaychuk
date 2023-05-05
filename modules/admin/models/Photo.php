<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%photo}}".
 *
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property string $file
 * @property int $type
 *
 * @property ProjectPhoto[] $projectPhotos
 */
class Photo extends \yii\db\ActiveRecord
{
    const AUTHOR_TYPE = 0;  // Тип фото "авторское"
    const PROJECT_TYPE = 1; // Тип фото "проектное"

    public $photo_file; // Файл фото
    public $project;    // Проект

    /**
     * @return string table name
     */
    public static function tableName()
    {
        return '{{%photo}}';
    }

    /**
     * @return array the validation rules
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['file'], 'string'],
            [['project'], 'safe'],
            ['photo_file', 'file', 'skipOnEmpty'=>!$this->isNewRecord, 'checkExtensionByMimeType' => false,
                'extensions' => ['jpg', 'jpeg', 'png']],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'PHOTO_MODEL_ID'),
            'created_at' => Yii::t('app', 'PHOTO_MODEL_CREATED_AT'),
            'updated_at' => Yii::t('app', 'PHOTO_MODEL_UPDATED_AT'),
            'file' => Yii::t('app', 'PHOTO_MODEL_FILE'),
            'type' => Yii::t('app', 'PHOTO_MODEL_TYPE'),
            'photo_file' => Yii::t('app', 'PHOTO_MODEL_FILE'),
            'project' => Yii::t('app', 'PHOTO_MODEL_PROJECT'),
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * Gets query for [[ProjectPhotos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjectPhotos()
    {
        return $this->hasMany(ProjectPhoto::class, ['photo' => 'id']);
    }

    /**
     * Получение списка типов фото.
     *
     * @return array - массив всех возможных типов фото
     */
    public static function getTypesArray()
    {
        return [
            self::AUTHOR_TYPE => Yii::t('app', 'PHOTO_MODEL_AUTHOR_TYPE'),
            self::PROJECT_TYPE => Yii::t('app', 'PHOTO_MODEL_PROJECT_TYPE'),
        ];
    }

    /**
     * Получение названия типа фото.
     *
     * @return mixed|null
     * @throws \Exception
     */
    public function getTypeName()
    {
        return ArrayHelper::getValue(self::getTypesArray(), $this->type);
    }
}