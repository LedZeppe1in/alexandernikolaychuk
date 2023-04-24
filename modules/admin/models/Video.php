<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%video}}".
 *
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property string $link
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * @return string table name
     */
    public static function tableName()
    {
        return '{{%video}}';
    }

    /**
     * @return array the validation rules
     */
    public function rules()
    {
        return [
            [['link'], 'required'],
            [['link'], 'string'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'VIDEO_MODEL_ID'),
            'created_at' => Yii::t('app', 'VIDEO_MODEL_CREATED_AT'),
            'updated_at' => Yii::t('app', 'VIDEO_MODEL_UPDATED_AT'),
            'link' => Yii::t('app', 'VIDEO_MODEL_LINK'),
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
}