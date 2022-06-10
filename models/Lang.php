<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lang".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $status
 *
 * @property Abitur[] $abiturs
 * @property Direction[] $directions
 */
class Lang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'default', 'value' => null],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Abiturs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAbiturs()
    {
        return $this->hasMany(Abitur::className(), ['lang_id' => 'id']);
    }

    /**
     * Gets query for [[Directions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirections()
    {
        return $this->hasMany(Direction::className(), ['lang_id' => 'id']);
    }
}
