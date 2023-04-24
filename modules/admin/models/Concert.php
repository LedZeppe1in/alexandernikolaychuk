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
 * @property string|null $name
 * @property string|null $poster
 * @property string|null $links
 */
class Concert extends \yii\db\ActiveRecord
{
    /**
     * @return string table name
     */
    public static function tableName()
    {
        return '{{%concert}}';
    }

    /**
     * @return array the validation rules
     */
    public function rules()
    {
        return [
            [['poster', 'links'], 'string'],
            [['name'], 'string', 'max' => 255],
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
            'name' => Yii::t('app', 'CONCERT_MODEL_NAME'),
            'poster' => Yii::t('app', 'CONCERT_MODEL_POSTER'),
            'links' => Yii::t('app', 'CONCERT_MODEL_LINKS'),
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
}