<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "direction".
 *
 * @property int $id
 * @property int $edu_id
 * @property string $name
 * @property int $lang_id
 * @property int|null $status
 *
 * @property Edu $edu
 * @property Lang $lang
 */
class Direction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'direction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['edu_id', 'name', 'lang_id'], 'required'],
            [['edu_id', 'lang_id', 'status'], 'default', 'value' => null],
            [['edu_id', 'lang_id', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['edu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Edu::className(), 'targetAttribute' => ['edu_id' => 'id']],
            [['lang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lang::className(), 'targetAttribute' => ['lang_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'edu_id' => 'Edu ID',
            'name' => 'Name',
            'lang_id' => 'Lang ID',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Edu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEdu()
    {
        return $this->hasOne(Edu::className(), ['id' => 'edu_id']);
    }

    /**
     * Gets query for [[Lang]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLang()
    {
        return $this->hasOne(Lang::className(), ['id' => 'lang_id']);
    }
}
