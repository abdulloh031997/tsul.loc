<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="person-form">
    <div class="row">
        <div class="col-12">
            <div class="card  border-top border-primary shadow-5 mx-0  mb-4">
                <div class="card-header pb-0">
                    <h6 class="text-center text-uppercase">Shaxsiy ma'lumotlar</h6>
                </div>
                <div class="card-body px-2 pt-0 pb-2">
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="row">
                        <div class="col-md-4"><?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-md-4"><?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-md-4"><?= $form->field($model, 'mname')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-md-4"><?= $form->field($model, 'bdate')->widget(\kartik\date\DatePicker::classname(),[
                                'type' => \kartik\date\DatePicker::TYPE_INPUT,
                                'language' => 'ru',
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'yyyy-mm-dd',
                                ]
                            ]);?></div>
                        <div class="col-md-4"><?= $form->field($model, 'sex')->widget(\kartik\select2\Select2::classname(), [
                                'data' => ['1'=>'Erkak','0'=>'Ayol'],
                                'options' => ['placeholder' => 'Test topshirish hududi', 'multiple' => false],
                                'theme' => \kartik\select2\Select2::THEME_KRAJEE,
                            ]); ?></div>
                        <div class="col-md-4"><?= $form->field($model, 'nation_id')->widget(\kartik\select2\Select2::classname(), [
                                'data' =>\yii\helpers\ArrayHelper::map(\app\models\Nation::find()->orderBy(['id'=>SORT_ASC])->all(),'id','name'),
                                'options' => ['placeholder' => Yii::t('app','Tanlash'), 'multiple' => false],
                                'theme' => \kartik\select2\Select2::THEME_KRAJEE,
                            ]);  ?></div>
                        <div class="col-md-4"><label for=""><?=Yii::t('app','Rasim 3x4')?></label>
                            <?= $form->field($model, 'file')->fileInput(['maxlength' => true])->label(false) ?></div>
                        <div class="col-md-4"><label for=""><?=Yii::t('app','Shahodat noma')?></label>
                            <?= $form->field($model, 'file_one')->fileInput(['maxlength' => true])->label(false) ?></div>
                    </div>
                    <div class="form-group">
                        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>


</div>
