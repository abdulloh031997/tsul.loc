<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
use app\models\Sms;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $password;
    public $password_repeat;
    public $verifyCode;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Bu telefon nomer oldin ro\'yxatdan o\'tgan!!!'],
            ['username', 'match', 'pattern' => '/^\d{9}$/', 'message' => 'Telefon nomer 12 ta raqamdan iborat bo\'lishi kerak!!!'],
            
            ['password', 'required'],
            ['password', 'string', 'min' => 8],
            [['password'], 'passwordStrength'],

            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Parollar bir-biriga mos kelmadi" ],

            ['username', 'required'],
            ['verifyCode', 'captcha'],
        ];
    }

    public function passwordStrength($attribute)
    {
//        $pattern = '/^(?=.*[a-z-0-9]).{5,}$/';
        $pattern = '/^(?=.*[a-zA-Z0-9]).{8,}$/';
//        $pattern = '/^(?=.*\d(?=.*\d))(?=.*[a-z](?=.*[a-z]))(?=.*[0-9](?=.*[0-9])).{8,}$/';
        if(!preg_match($pattern, $this->$attribute))
            $this->addError($attribute, 'your password is not strong enough!');
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => Yii::t('app','Phone number'),
            'password' => Yii::t('app','Password'),
            'password_repeat' =>Yii::t('app','Rewrite password') ,
            'verifyCode'=> 'Verification code'
        ];
    }


    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */


    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->setPassword($this->password);
        if ($user->save()){
            $username = $user->username;
            return $this->sendSms($username);
        }
        return false;
    }
    public function reset()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = User::findOne(['username'=>$this->username]);
        $user->setPassword($this->password);
        if ($user->save()){
            $username = $user->username;
            return $this->sendSms($username);
        }
        return false;
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */

    protected function sendSms($username)
    {
        return Sms::create($username, 101);
    }
}