<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "edu".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 *
 * @property Direction[] $directions
 */
class Edu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'edu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
     * Gets query for [[Directions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirections()
    {
        return $this->hasMany(Direction::className(), ['edu_id' => 'id']);
    }
}
