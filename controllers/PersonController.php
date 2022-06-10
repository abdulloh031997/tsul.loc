<?php

namespace app\controllers;

use app\models\Abitur;
use app\models\Direction;
use app\models\OldEdu;
use app\models\Person;
use app\models\PersonAddress;
use app\models\Region;
use app\models\Scholl;
use app\models\search\PersonSearch;
use yii\base\BaseObject;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * PersonController implements the CRUD actions for Person model.
 */
class PersonController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login','error'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','error','index','create','address','old-edu','abitur','get-district','old-district','get-scholl','get-direction'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Person models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $user = Yii::$app->user->identity->id;
        if (isset($user) && !empty($user)) {
            return $this->render('index');
        } else {
            Yii::$app->session->setFlash('warning', "Xizmat yopiq");
            return $this->render('index');
        }
    }

    /**
     * Displays a single Person model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Person model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $user = Yii::$app->user->identity->id;
        if (isset($user) && !empty($user)) {
            $model = Person::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
            if (!isset($model)) {
                $model = new Person();
            }
            if ($model->load($this->request->post())) {
                if ($model->save()) {
                    return $this->redirect('address');
                }
            }
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        else {
            Yii::$app->session->setFlash('danger', "Xizmat yopiq");
            return $this->render('index');
        }
    }

    public function actionAddress()
    {
        $user = Yii::$app->user->identity;
        if (isset($user->id) && !empty($user->id) && isset($user->person->id)) {
            $model = PersonAddress::find()->where(['user_id' => $user->id])->andWhere(['person_id' => $user->person->id])->one();
            if (!isset($model)) {
                $model = new PersonAddress();
            }
            if ($this->request->isPost) {
                if ($model->load($this->request->post())) {
                    if ($model->save()) {
                        return $this->redirect('old-edu');
                    }
                }
            }
            return $this->render('address', [
                'model' => $model,
            ]);
        }
        else {
            Yii::$app->session->setFlash('danger', "Xizmat yopiq");
            return $this->render('index');
        }
    }

    public function actionOldEdu()
    {
        $user = Yii::$app->user->identity;
        if (isset($user->id) && !empty($user->id) && isset($user->person->id)) {
            $model = OldEdu::find()->where(['user_id' => $user->id])->one();
            if (!isset($model)) {
                $model = new OldEdu();
            }
            if ($this->request->isPost) {
                if ($model->load($this->request->post())) {
                    if ($model->save()) {
                        return $this->redirect('abitur');
                    } else {
                        print_r($model->getErrors());
                    }
                }
            }
            return $this->render('old-edu', [
                'model' => $model,
            ]);
        }
        else {
            Yii::$app->session->setFlash('danger', "Xizmat yopiq");
            return $this->render('index');
        }
    }

    public function actionAbitur()
    {
        $user = Yii::$app->user->identity;
        if (isset($user->id) && !empty($user->id) && isset($user->old->id)) {
            $model = Abitur::find()->where(['user_id' => $user->id])->one();
            if (!isset($model)) {
                $model = new Abitur();
            }
            if ($this->request->isPost) {
                if ($model->load($this->request->post())) {
                    if ($model->save()) {
                        return $this->redirect('index');
                    } else {
                        print_r($model->getErrors());
                    }
                }
            }
            return $this->render('abitur', [
                'model' => $model,
            ]);
        }
        else {
            Yii::$app->session->setFlash('danger', "Xizmat yopiq");
            return $this->render('index');
        }
    }

    public function actionGetDistrict($id = null)
    {
        $tuman = Region::find()->where(['parent_id' => $id])->all();
        echo '<select id="personaddress-district_id" class="select2 select2-hidden-accessible" name="PersonAddress[district_id]" data-select2-id="personaddress-district_id" tabindex="-1" aria-hidden="true">';
        foreach ($tuman as $value) {
            echo '<option value="' . $value->id . '">' . $value->name . '</option>';
        }
        echo '</select>';
        die();
    }

    public function actionOldDistrict($id = null)
    {
        $tuman = Region::find()->where(['parent_id' => $id])->all();
        echo '<select id="oldedu-district_id" class="select2 select2-hidden-accessible" name="OldEdu[district_id]" data-select2-id="oldedu-district_id" tabindex="-1" aria-hidden="true">';
        foreach ($tuman as $value) {
            echo '<option value="' . $value->id . '">' . $value->name . '</option>';
        }
        echo '</select>';
        die();
    }

    public function actionGetScholl($id = null)
    {
        $tuman = Scholl::find()->where(['region_id' => $id])->all();
        echo '<select id="oldedu-scholl_id" class="select2 select2-hidden-accessible" name="OldEdu[scholl_id]" data-select2-id="oldedu-scholl_id" tabindex="-1" aria-hidden="true">';
        foreach ($tuman as $value) {
            echo '<option value="' . $value->id . '">' . $value->name . '</option>';
        }
        echo '</select>';
        die();
    }

    public function actionGetDirection($id = null)
    {
        $tuman = Direction::find()->where(['lang_id' => $id])->all();
        echo '<select id="abitur-direction_id" class="select2 select2-hidden-accessible" name="Abitur[direction_id]" data-select2-id="abitur-direction_id" tabindex="-1" aria-hidden="true">';
        foreach ($tuman as $value) {
            echo '<option value="' . $value->id . '">' . $value->name . '</option>';
        }
        echo '</select>';
        die();
    }

    /**
     * Updates an existing Person model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Person model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Person model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Person the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Person::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
