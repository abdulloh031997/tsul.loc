<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "flang".
 *
 * @property int $id
 * @property string $name
 * @property int|null $status
 *
 * @property Abitur[] $abiturs
 */
class Flang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'flang';
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
     * Gets query for [[Abiturs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAbiturs()
    {
        return $this->hasMany(Abitur::className(), ['flang_id' => 'id']);
    }
}
