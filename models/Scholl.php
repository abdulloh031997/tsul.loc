<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scholl".
 *
 * @property int $id
 * @property string $name
 * @property string $name_ru
 * @property string $name_qq
 * @property int $type_id
 * @property bool $status
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $region_id
 */
class Scholl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'scholl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'name_ru', 'name_qq', 'type_id', 'status', 'region_id'], 'required'],
            [['type_id', 'region_id'], 'default', 'value' => null],
            [['type_id', 'region_id'], 'integer'],
            [['status'], 'boolean'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'name_ru', 'name_qq'], 'string', 'max' => 255],
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
            'name_ru' => 'Name Ru',
            'name_qq' => 'Name Qq',
            'type_id' => 'Type ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'region_id' => 'Region ID',
        ];
    }
}
