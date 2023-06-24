<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%music_album}}".
 *
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property string $name_ru
 * @property string $name_en
 * @property int $type
 * @property string|null $cover_ru
 * @property string|null $cover_en
 * @property string|null $links
 * @property string|null $description_ru
 * @property string|null $description_en
 * @property string|null $authors_ru
 * @property string|null $authors_en
 *
 * @property ProjectAlbum[] $projectAlbums
 */
class MusicAlbum extends \yii\db\ActiveRecord
{
    const AUTHOR_TYPE = 0;  // Тип альбома "авторский"
    const PROJECT_TYPE = 1; // Тип альбома "проектный"

    public $cover_file_ru; // Файл обложки на русском
    public $cover_file_en; // Файл обложки на английском
    public $project;       // Проект

    /**
     * @return string table name
     */
    public static function tableName()
    {
        return '{{%music_album}}';
    }

    /**
     * @return array the validation rules
     */
    public function rules()
    {
        return [
            [['name_ru', 'name_en', 'type'], 'required'],
            [['cover_ru', 'cover_en', 'links', 'description_ru', 'description_en', 'authors_ru', 'authors_en'],
                'string'],
            [['name_ru', 'name_en'], 'string', 'max' => 255],
            [['project'], 'safe'],
            ['cover_file_ru', 'file', 'checkExtensionByMimeType' => false, 'extensions' => ['jpg', 'jpeg', 'png']],
            ['cover_file_en', 'file', 'checkExtensionByMimeType' => false, 'extensions' => ['jpg', 'jpeg', 'png']],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'MUSIC_ALBUM_MODEL_ID'),
            'created_at' => Yii::t('app', 'MUSIC_ALBUM_MODEL_CREATED_AT'),
            'updated_at' => Yii::t('app', 'MUSIC_ALBUM_MODEL_UPDATED_AT'),
            'name_ru' => Yii::t('app', 'MUSIC_ALBUM_MODEL_NAME_RU'),
            'name_en' => Yii::t('app', 'MUSIC_ALBUM_MODEL_NAME_EN'),
            'type' => Yii::t('app', 'MUSIC_ALBUM_MODEL_TYPE'),
            'cover_ru' => Yii::t('app', 'MUSIC_ALBUM_MODEL_COVER_RU'),
            'cover_en' => Yii::t('app', 'MUSIC_ALBUM_MODEL_COVER_EN'),
            'links' => Yii::t('app', 'MUSIC_ALBUM_MODEL_LINKS'),
            'description_ru' => Yii::t('app', 'MUSIC_ALBUM_MODEL_DESCRIPTION_RU'),
            'description_en' => Yii::t('app', 'MUSIC_ALBUM_MODEL_DESCRIPTION_EN'),
            'authors_ru' => Yii::t('app', 'MUSIC_ALBUM_MODEL_AUTHORS_RU'),
            'authors_en' => Yii::t('app', 'MUSIC_ALBUM_MODEL_AUTHORS_EN'),
            'cover_file_ru' => Yii::t('app', 'MUSIC_ALBUM_MODEL_COVER_RU'),
            'cover_file_en' => Yii::t('app', 'MUSIC_ALBUM_MODEL_COVER_EN'),
            'project' => Yii::t('app', 'MUSIC_ALBUM_MODEL_PROJECT'),
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
        return $this->hasMany(ProjectAlbum::class, ['music_album' => 'id']);
    }

    /**
     * Получение списка типов музыкальных альбомов.
     *
     * @return array - массив всех возможных типов музыкальных альбомов
     */
    public static function getTypesArray()
    {
        return [
            self::AUTHOR_TYPE => Yii::t('app', 'MUSIC_ALBUM_MODEL_AUTHOR_TYPE'),
            self::PROJECT_TYPE => Yii::t('app', 'MUSIC_ALBUM_MODEL_PROJECT_TYPE')
        ];
    }

    /**
     * Получение названия типа музыкального альбома.
     *
     * @return mixed|null
     * @throws \Exception
     */
    public function getTypeName()
    {
        return ArrayHelper::getValue(self::getTypesArray(), $this->type);
    }
}