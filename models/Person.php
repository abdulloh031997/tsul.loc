<?php

namespace app\models;

use app\components\UploadBehaviorStorege;
use Yii;

/**
 * This is the model class for table "person".
 *
 * @property int $id
 * @property string $fname
 * @property string $lname
 * @property string $mname
 * @property string $bdate
 * @property string|null $sex
 * @property int $nation_id
 * @property string $created_at
 * @property string|null $updated_at
 * @property string $image
 * @property int $user_id
 *
 * @property PersonAddress[] $personAddresses
 * @property User $user
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'person';
    }
    public $file;
    public $file_one;
    public function behaviors(){
        return [
            [
                'class' => UploadBehaviorStorege::className(),
                'imageFile' => 'file',
                'photo' => 'image',
                 'path' => 'uploads/tsul_akl',
//                'path' => '/data2022/flangCertList',
            ],
            [
                'class' => UploadBehaviorStorege::className(),
                'imageFile' => 'file_one',
                'photo' => 'image_shaxodatnoma',
                 'path' => 'uploads/tsul_akl/image_shaxodatnoma',
//                'path' => '/data2022/flangCertList',
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fname', 'lname', 'mname', 'bdate', 'nation_id'], 'required'],
            [['bdate', 'created_at', 'updated_at'], 'safe'],
            [[ 'user_id'], 'default', 'value' => Yii::$app->user->identity->id],
            [['nation_id', 'user_id'], 'integer'],
            [['fname', 'lname', 'mname', 'sex', 'image','image_shaxodatnoma'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            ['file', 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg,tiff,svg', 'maxSize' => 1024*1024*10],
            ['image_shaxodatnoma', 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg,tiff,svg', 'maxSize' => 1024*1024*10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fname' => 'Ism',
            'lname' => 'Familiya',
            'mname' => 'Sharif',
            'bdate' => 'Tug‘ilgan sana',
            'sex' => 'Jinsi',
            'nation_id' => 'Millati',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'image' => 'Rasim',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[PersonAddresses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonAddresses()
    {
        return $this->hasMany(PersonAddress::className(), ['person_id' => 'id']);
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
