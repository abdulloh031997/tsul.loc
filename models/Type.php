<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "type".
 *
 * @property int $id
 * @property string $name
 * @property string $name_ru
 * @property string $name_qq
 * @property int|null $order_id
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'name_ru', 'name_qq'], 'required'],
            [['order_id'], 'default', 'value' => null],
            [['order_id'], 'integer'],
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
            'order_id' => 'Order ID',
        ];
    }
}
