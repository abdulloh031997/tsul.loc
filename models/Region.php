<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property int $id
 * @property string $name
 * @property string|null $create_at
 * @property string|null $update
 * @property string $name_ru
 * @property int|null $order_id
 * @property string $name_qq
 * @property int|null $xtv_id
 * @property int|null $dtm_id
 * @property string|null $name_uz
 * @property int|null $parent_id
 * @property int|null $km
 * @property bool|null $is_test
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'name_ru', 'name_qq'], 'required'],
            [['id', 'order_id', 'xtv_id', 'dtm_id', 'parent_id', 'km'], 'default', 'value' => null],
            [['id', 'order_id', 'xtv_id', 'dtm_id', 'parent_id', 'km'], 'integer'],
            [['create_at', 'update'], 'safe'],
            [['is_test'], 'boolean'],
            [['name', 'name_ru', 'name_qq'], 'string', 'max' => 80],
            [['name_uz'], 'string', 'max' => 200],
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
            'create_at' => 'Create At',
            'update' => 'Update',
            'name_ru' => 'Name Ru',
            'order_id' => 'Order ID',
            'name_qq' => 'Name Qq',
            'xtv_id' => 'Xtv ID',
            'dtm_id' => 'Dtm ID',
            'name_uz' => 'Name Uz',
            'parent_id' => 'Parent ID',
            'km' => 'Km',
            'is_test' => 'Is Test',
        ];
    }
}
