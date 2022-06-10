<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Region;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Create Address';
$this->params['breadcrumbs'][] = ['label' => 'People', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$region = ArrayHelper::map(Region::find()
    ->where(['between', 'id', "1000", "2000"])
    ->orderBy('id')
    ->all(), 'id', 'name');
$user = Yii::$app->user->identity;
if ($user->address) {
    $tuman = ArrayHelper::map(Region::find()
        ->where(['parent_id' => $user->address->region_id])
        ->all(), 'id', 'name');
} else {
    $tuman = [];
}
?>

<div class="person-form">
    <div class="row">
        <div class="col-12">
            <div class="card border mb-4">
                <div class="card-header pb-0">
                    <h6 class="text-center">Yashash Address</h6>
                </div>
                <div class="card-body px-2 pt-0 pb-2">
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="row">
                        <div class="col-md-4"><?= $form->field($model, 'region_id')->dropDownList(
                                $region,
                                [
                                    'prompt' => 'Viloyat',
                                    'onchange' => '
                                            $.get("get-district?id="+$(this).val(), function( data ) {
                                              $("#personaddress-district_id").html(data);
                                            });',
                                    'class' => 'form-control select2'
                                ]
                            ); ?></div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'district_id')->dropDownList(
                                $tuman,
                                ['prompt' => 'Tuman', 'class' => 'form-control select2']
                            ); ?></div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="form-group">
                            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>


    </div>
