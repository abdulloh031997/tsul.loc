<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sms_status".
 *
 * @property int $code
 * @property string|null $name
 * @property string|null $name_ru
 * @property string|null $name_qq
 * @property string|null $created_at
 *
 * @property Sms[] $sms
 */
class SmsStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sms_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['code'], 'default', 'value' => null],
            [['code'], 'integer'],
            [['created_at'], 'safe'],
            [['name', 'name_ru', 'name_qq'], 'string', 'max' => 140],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'name' => 'Name',
            'name_ru' => 'Name Ru',
            'name_qq' => 'Name Qq',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Sms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSms()
    {
        return $this->hasMany(Sms::className(), ['status_code' => 'code']);
    }
}
