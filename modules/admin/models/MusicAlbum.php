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
 * @property string $name
 * @property int $type
 * @property string|null $cover
 * @property string|null $links
 * @property string|null $description
 * @property string|null $author
 *
 * @property ProjectAlbum[] $projectAlbums
 */
class MusicAlbum extends \yii\db\ActiveRecord
{
    const AUTHOR_TYPE = 0;  // Тип альбома "авторский"
    const PROJECT_TYPE = 1; // Тип альбома "проектный"

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
            [['name', 'type'], 'required'],
            [['cover', 'links', 'description', 'author'], 'string'],
            [['name'], 'string', 'max' => 255],
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
            'name' => Yii::t('app', 'MUSIC_ALBUM_MODEL_NAME'),
            'type' => Yii::t('app', 'MUSIC_ALBUM_MODEL_TYPE'),
            'cover' => Yii::t('app', 'MUSIC_ALBUM_MODEL_COVER'),
            'links' => Yii::t('app', 'MUSIC_ALBUM_MODEL_LINKS'),
            'description' => Yii::t('app', 'MUSIC_ALBUM_MODEL_DESCRIPTION'),
            'author' => Yii::t('app', 'MUSIC_ALBUM_MODEL_AUTHOR'),
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