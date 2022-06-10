<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "old_edu".
 *
 * @property int $id
 * @property int $region_id
 * @property int $district_id
 * @property int|null $scholl_id
 * @property int $user_id
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $is_scholl
 * @property string|null $scholl_name
 *
 * @property Region $district
 * @property Region $region
 * @property Scholl $scholl
 * @property User $user
 */
class OldEdu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'old_edu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_id', 'district_id'], 'required'],
            [['user_id'], 'default', 'value' => Yii::$app->user->identity->id],
            [['region_id', 'district_id', 'scholl_id', 'user_id', 'is_scholl'], 'default', 'value' => null],
            [['region_id', 'district_id', 'scholl_id', 'user_id', 'is_scholl'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['scholl_name'], 'string', 'max' => 255],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['district_id' => 'id']],
            [['scholl_id'], 'exist', 'skipOnError' => true, 'targetClass' => Scholl::className(), 'targetAttribute' => ['scholl_id' => 'id']],
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
            'region_id' => 'Region ID',
            'district_id' => 'District ID',
            'scholl_id' => 'Scholl ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'is_scholl' => 'Boshqa Maktab',
            'scholl_name' => 'Scholl Name',
        ];
    }

    /**
     * Gets query for [[District]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(Region::className(), ['id' => 'district_id']);
    }

    /**
     * Gets query for [[Region]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    /**
     * Gets query for [[Scholl]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getScholl()
    {
        return $this->hasOne(Scholl::className(), ['id' => 'scholl_id']);
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
