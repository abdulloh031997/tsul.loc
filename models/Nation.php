<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nation".
 *
 * @property int $id
 * @property string $name
 * @property string $name_ru
 * @property string|null $create_at
 * @property string|null $update_at
 * @property string|null $name_qq
 */
class Nation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'name_ru'], 'required'],
            [['id'], 'default', 'value' => null],
            [['id'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
            [['name', 'name_qq'], 'string', 'max' => 20],
            [['name_ru'], 'string', 'max' => 30],
            [['id'], 'unique'],
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
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'name_qq' => 'Name Qq',
        ];
    }
}
