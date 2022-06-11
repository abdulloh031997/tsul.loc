<?php

namespace app\models;

use app\components\UploadBehaviorStorege;
use Yii;

/**
 * This is the model class for table "abitur".
 *
 * @property int $id
 * @property int $user_id
 * @property int $lang_id
 * @property int $flang_id
 * @property int $edu_id
 * @property int $direction_id
 * @property string|null $image_cert
 * @property string|null $image_olympic
 *
 * @property Flang $flang
 * @property Lang $lang
 * @property User $user
 */
class Abitur extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'abitur';
    }
    public $file_one;
    public $file_two;
    public function behaviors(){
        return [
            [
                'class' => UploadBehaviorStorege::className(),
                'imageFile' => 'file_one',
                'photo' => 'image_cert',
                'path' => 'uploads/tsul_akl/image_cert',
//                'path' => '/data2022/flangCertList',
            ],
            [
                'class' => UploadBehaviorStorege::className(),
                'imageFile' => 'file_two',
                'photo' => 'image_olympic',
                'path' => 'uploads/tsul_akl/image_olympic',
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
            [['lang_id', 'flang_id', 'edu_id', 'direction_id'], 'required'],
            [['user_id', 'lang_id', 'flang_id', 'edu_id', 'direction_id'], 'default', 'value' => null],
            [['user_id'], 'default', 'value' => Yii::$app->user->identity->id],
            [['user_id', 'lang_id', 'flang_id', 'edu_id', 'direction_id'], 'integer'],
            [['image_cert', 'image_olympic'], 'string', 'max' => 255],
            [['direction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Direction::className(), 'targetAttribute' => ['direction_id' => 'id']],
            [['edu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Edu::className(), 'targetAttribute' => ['edu_id' => 'id']],
            [['flang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Flang::className(), 'targetAttribute' => ['flang_id' => 'id']],
            [['lang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lang::className(), 'targetAttribute' => ['lang_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            ['file_one', 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg,tiff,svg', 'maxSize' => 1024*1024*10],
            ['file_two', 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg,tiff,svg', 'maxSize' => 1024*1024*10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'lang_id' => "Ta'lim tili",
            'flang_id' => 'Chet tili',
            'edu_id' => 'Litsey',
            'direction_id' => "Yo‘nalish",
            'image_cert' => 'Chet tili sertifikati',
            'image_olympic' => 'Olimpiyada  sertifikati',
        ];
    }

    /**
     * Gets query for [[Flang]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFlang()
    {
        return $this->hasOne(Flang::className(), ['id' => 'flang_id']);
    }

    /**
     * Gets query for [[Lang]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLang()
    {
        return $this->hasOne(Lang::className(), ['id' => 'lang_id']);
    }
    public function getEdu()
    {
        return $this->hasOne(Edu::className(), ['id' => 'edu_id']);
    }public function getDirection()
    {
        return $this->hasOne(Direction::className(), ['id' => 'direction_id']);
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
