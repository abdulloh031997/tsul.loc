<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Region;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Create OldEdu';
$this->params['breadcrumbs'][] = ['label' => 'People', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$region = ArrayHelper::map(Region::find()
    ->where(['between', 'id', "1000", "2000"])
    ->orderBy('id')
    ->all(), 'id', 'name');
$user = Yii::$app->user->identity;
if ($user->old) {
    $tuman = ArrayHelper::map(Region::find()
        ->where(['parent_id' => $user->old->region_id])
        ->all(), 'id', 'name');
    $scholl = ArrayHelper::map(\app\models\Scholl::find()
        ->where(['region_id' => $user->old->district_id])
        ->all(), 'id', 'name');
} else {
    $tuman = [];
    $scholl = [];
}
?>

<div class="person-form">
    <div class="row">
        <div class="col-12">
            <div class="card border mb-4">
                <div class="card-header pb-0">
                    <h6 class="text-center">Tugatgan ta'lim muassasi</h6>
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
                                              $("#oldedu-district_id").html(data);
                                            });',
                                    'class' => 'form-control select2'
                                ]
                            ); ?></div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'district_id')->dropDownList(
                                $tuman,
                                [
                                    'prompt' => 'Tuman',
                                    'onchange' => '
                                            $.get("get-scholl?id="+$(this).val(), function( data ) {
                                              $("#oldedu-scholl_id").html(data);
                                            });',
                                    'class' => 'form-control select2'
                                ]
                            ); ?></div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'scholl_id')->dropDownList(
                                $scholl,
                                ['prompt' => 'Maktab', 'class' => 'form-control  select2']) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'is_scholl')->checkbox(['class'=>'']) ?>
                        </div>
                        <div class="col-md-4" id="ShcollName">
                            <?= $form->field($model, 'scholl_name')->textInput() ?>
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
</div>
<style>
    #ShcollName{
        display:none;
    }
</style>
<script>
        <?php ob_start() ?>
        $('input[name="OldEdu[is_scholl]"]').on('click', function(){
            if ( $(this).is(':checked') ) {
                $('#ShcollName').css("display","block")
            }
            else {
                $('#ShcollName').css("display","none")
            }
        });
        <?php $this->registerJs(ob_get_clean()) ?>
</script>