<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string|null $auth_key
 * @property string|null $password_reset_token
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property bool|null $status
 * @property string|null $url
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'default','value'=>0],
            [['password'], 'string', 'max' => 100],
            [['password'], 'string', 'min' => 8],
            [['url'], 'string', 'max' => 64],
            [['auth_key', 'password_reset_token'], 'string', 'max' => 255],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'username' => Yii::t('app','Phone'),
            'password' => Yii::t('app','Password'),
            'status' => Yii::t('app','Status'),
            'auth_key' => 'Auth Key',
            'password_reset_token' => 'Password Reset Token',
            'created_at' => 'Create At',
            'updated_at' => 'Update At',
        ];
    }

    /**
     * Gets query for [[Person]].
     *
     * @return \yii\db\ActiveQuery
     */

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
        // TODO: Implement getId() method.
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function validatePassword($password)
    {
        return $this->status == 1 && Yii::$app->security->validatePassword($password, $this->password);
    }
    public function getUsername()
    {
        return $this->name;
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        $user = static::findOne($id);
        return $user;
        // TODO: Implement findIdentity() method.
    }
    public function getName()
    {
        return $this->username;
    }
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['user_id' => 'id']);
    }

    public function getAddress()
    {
        return $this->hasOne(PersonAddress::className(), ['user_id' => 'id']);
    }
    public function getOld()
    {
        return $this->hasOne(OldEdu::className(), ['user_id' => 'id']);
    }
    public function getAbitur()
    {
        return $this->hasOne(Abitur::className(), ['user_id' => 'id']);
    }
}
