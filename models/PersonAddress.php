<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "person_address".
 *
 * @property int $id
 * @property int $person_id
 * @property int $region_id
 * @property int $district_id
 * @property string $address
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $user_id
 *
 * @property Person $person
 * @property User $user
 */
class PersonAddress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'person_address';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_id', 'district_id', 'address'], 'required'],
            [['user_id'], 'default', 'value' => Yii::$app->user->identity->id],
            [['person_id'], 'default', 'value' => Yii::$app->user->identity->person->id],
            [['person_id', 'region_id', 'district_id', 'user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['address'], 'string', 'max' => 255],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['person_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'person_id' => 'Person ID',
            'region_id' => 'Region ID',
            'district_id' => 'District ID',
            'address' => 'Address',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Person]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'person_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
