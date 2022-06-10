<?php

namespace app\controllers;

use app\models\Sms;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'hr\captcha\CaptchaAction',
                'operators' => ['+','-','*'],
                'maxValue' => 10,
                'fontSize' => 15,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect('person/index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */

    public function actionLogin()
    {
        $this->layout='login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }elseif($model->user){
            if(!$model->user->status){
                $sms = Sms::create($model->username, 101);
                $sended_sms = Sms::findOne($sms->id);
                return $this->render('sms-activation', [
                    'sms' => $sended_sms
                ]);
            }
        }
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    
    public function actionRegister()
    {
        $this->layout='login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new SignupForm();
         if ($model->load(Yii::$app->request->post()) && $sms = $model->signup()) {
             $sended_sms = Sms::findOne($sms->id);
             return $this->render('sms-activation', [
                 'sms' => $sended_sms
             ]);
         }
        return $this->render('register', [
            'model' => $model,
        ]);
    }
    public function actionSmsActivation()
    {
        $this->layout='login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new Sms();
        if ($model->load(Yii::$app->request->post())) {
            $id = Yii::$app->request->post('Sms')['id'];
            $cod = Yii::$app->request->post('Sms')['resivied_sms'];
            $sms_model = Sms::findOne($id);
            if ($sms_model->sms_send == $cod){
                $user = User::find()->where(['username' => strval($sms_model->phone)])->one();
                $user->status = 1;
                $user->save();
                $sms_model->status = 1;
                $sms_model->save();
                Yii::$app->user->login($user);
            }
            return $this->redirect('/');
        }
        return $this->render('register', [
            'model' => $model,
        ]);
    }
    public function actionSms()
    {
        $model = new Sms();
        if ($model->load(Yii::$app->request->post())) {
            $id = Yii::$app->request->post('Sms')['id'];
            $cod = Yii::$app->request->post('Sms')['resivied_sms'];
            if(!empty($id) && is_numeric($id)){
                $sms_model = Sms::findOne($id);
            }else{
                return $this->redirect('/sms');
            }
            if (empty($sms_model) || $sms_model->status > 0){
                return $this->redirect('/');
            }
            if($cod == $sms_model->sms_send){
                if ($sms_model->status_code == 102) {
                    $sms_model->status = 1;
                    if($sms_model->save(false)){
                        $user = User::find()->where(['username' =>(string) $sms_model->phone])->one();
                        $user->url = $sms_model->phone . md5($sms_model->phone . time());
                        $user->update_at = date('Y-m-d H:i:s');
                        if($user->save(false)){
                            return $this->redirect('reset/'.$user->url);
                        }else{
                            prd($user->getErrors());
                        }
                    }

                }
            }
            return $this->render('sms', ['sms' => $sms_model]);
        }
        return $this->render('sms', ['sms' => $model]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
