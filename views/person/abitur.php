<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Edu;
use app\models\Lang;
use app\models\Flang;
use app\models\Direction;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
$this->title = "Ariza qoldirish";
$this->params['breadcrumbs'][] = ['label' => 'Bosh sahifa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$edu = ArrayHelper::map(Edu::find()
    ->all(), 'id', 'name');

$user = Yii::$app->user->identity;
if ($user->old) {
    $lang = ArrayHelper::map(Lang::find()
        ->all(), 'id', 'name');
    $direction = ArrayHelper::map(Direction::find()
        ->all(), 'id', 'name');
    $flang = ArrayHelper::map(Flang::find()
        ->all(), 'id', 'name');
} else {
    $flang = [];
    $direction = [];
}

?>
<div class="person-form">

    <div class="card  border-top border-primary shadow-5 mx-0  mb-4">
        <div class="card-header pb-0">
            <h6 class="text-center">ARIZA QOLDIRISH</h6>
        </div>
        <div class="card-body px-2 pt-0 pb-2">
            <?php $form = ActiveForm::begin(); ?>
            <div class="row">

                <div class="col-md-4">
                    <?= $form->field($model, 'edu_id')->dropDownList(
                        $edu,
                        [
                            'prompt' => 'Akademik litseyni tanlang',
                            'class' => 'form-control select2'
                        ]
                    ); ?></div>
                <div class="col-md-4"><?= $form->field($model, 'lang_id')->dropDownList(
                        $lang,
                        [
                            'prompt' => 'TA\'LIM TILI ',
                            'onchange' => '
                                            $.get("get-direction?id="+$(this).val(), function( data ) {
                                              $("#abitur-direction_id").html(data);
                                            });',
                            'class' => 'form-control select2'
                        ]
                    ); ?></div>
                <div class="col-md-4">
                    <?= $form->field($model, 'direction_id')->dropDownList(
                        $direction,
                        ['prompt' => 'Tuman', 'class' => 'form-control select2']) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'flang_id')->dropDownList(
                        $flang,
                        ['prompt' => 'flang_id', 'class' => 'form-control select2']) ?>
                </div>
                <div class="col-md-4"><label for=""><?= Yii::t('app', 'Chet tili sertifikati') ?></label>
                    <?= $form->field($model, 'file_one')->fileInput(['maxlength' => true])->label(false) ?>
                </div>
                <div class="col-md-4"><label for=""><?= Yii::t('app', 'Olimpiada sertifikati') ?></label>
                    <?= $form->field($model, 'file_two')->fileInput(['maxlength' => true])->label(false) ?>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
