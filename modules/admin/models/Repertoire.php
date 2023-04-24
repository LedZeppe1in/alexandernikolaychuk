<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%repertoire}}".
 *
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property string $name
 * @property int $type
 * @property string $composition_list 
 */
class Repertoire extends \yii\db\ActiveRecord
{
    const CONCERT_TYPE = 0;   // Тип репертуара "концертные программы"
    const ORCHESTRA_TYPE = 1; // Тип репертуара "репертуар с оркестром"

    /**
     * @return string table name
     */
    public static function tableName()
    {
        return '{{%repertoire}}';
    }

    /**
     * @return array the validation rules
     */
    public function rules()
    {
        return [
            [['name', 'type', 'composition_list'], 'required'],
            [['composition_list'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'REPERTOIRE_MODEL_ID'),
            'created_at' => Yii::t('app', 'REPERTOIRE_MODEL_CREATED_AT'),
            'updated_at' => Yii::t('app', 'REPERTOIRE_MODEL_UPDATED_AT'),
            'name' => Yii::t('app', 'REPERTOIRE_MODEL_NAME'),
            'type' => Yii::t('app', 'REPERTOIRE_MODEL_TYPE'),
            'composition_list ' => Yii::t('app', 'REPERTOIRE_MODEL_COMPOSITION_LIST')
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * Получение списка типов репертуаров.
     *
     * @return array - массив всех возможных типов репертуаров
     */
    public static function getTypesArray()
    {
        return [
            self::CONCERT_TYPE => Yii::t('app', 'REPERTOIRE_MODEL_CONCERT_TYPE'),
            self::ORCHESTRA_TYPE => Yii::t('app', 'REPERTOIRE_MODEL_ORCHESTRA_TYPE')
        ];
    }

    /**
     * Получение названия типа репертуара.
     *
     * @return mixed|null
     * @throws \Exception
     */
    public function getTypeName()
    {
        return ArrayHelper::getValue(self::getTypesArray(), $this->type);
    }
}