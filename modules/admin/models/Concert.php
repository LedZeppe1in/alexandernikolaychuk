<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%concert}}".
 *
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $name_ru
 * @property string|null $name_en
 * @property string|null $poster
 * @property string|null $links
 */
class Concert extends \yii\db\ActiveRecord
{
    public $poster_file;  // Файл афишы

    /**
     * @return string table name
     */
    public static function tableName()
    {
        return '{{%concert}}';
    }

    /**
     * Validation rule.
     *
     * @param $attribute_name
     * @param $params
     */
    public function either($attribute_name, $params)
    {
        if (!empty($this->$attribute_name))
            return;
        if (!is_array($params['other']))
            $params['other'] = [$params['other']];
        foreach($params['other'] as $field)
            if(!empty($this->$field))
                return;
        $fieldsLabels = [$this->getAttributeLabel($attribute_name)];
        foreach($params['other'] as $field)
            $fieldsLabels[] = $this->getAttributeLabel($field);
        $this->addError($attribute_name, Yii::t('app', 'CONCERT_MODEL_MESSAGE_REQUIRED'));
    }

    /**
     * @return array the validation rules
     */
    public function rules()
    {
        return [
            [['poster', 'links'], 'string'],
            [['name_ru', 'name_en'], 'string', 'max' => 255],
            [['name_ru', 'name_en'], 'either', 'skipOnEmpty'=>!$this->isNewRecord, 'params' => ['other' => 'poster_file']],
            ['poster_file', 'either', 'skipOnEmpty'=>!$this->isNewRecord, 'params' => ['other' => ['name_ru', 'name_en']]],
            ['poster_file', 'file', 'checkExtensionByMimeType' => false, 'extensions' => ['jpg', 'jpeg', 'png']],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'CONCERT_MODEL_ID'),
            'created_at' => Yii::t('app', 'CONCERT_MODEL_CREATED_AT'),
            'updated_at' => Yii::t('app', 'CONCERT_MODEL_UPDATED_AT'),
            'name_ru' => Yii::t('app', 'CONCERT_MODEL_NAME_RU'),
            'name_en' => Yii::t('app', 'CONCERT_MODEL_NAME_EN'),
            'poster' => Yii::t('app', 'CONCERT_MODEL_POSTER'),
            'links' => Yii::t('app', 'CONCERT_MODEL_LINKS'),
            'poster_file' => Yii::t('app', 'CONCERT_MODEL_POSTER'),
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
}