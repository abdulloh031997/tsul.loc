<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-header pb-0 text-left bg-transparent">
        <h3 class="font-weight-bolder text-info text-gradient">Tizimga kirish</h3>
        <p class="mb-0">Hurmatli foydalanuvchi, tizimdan foydalanish uchun telefon raqamingizni kiriting</p>
    </div>
    <div class="card-body">
        <?php $form = ActiveForm::begin(); ?>
        <label>TELEFON RAQAM</label>
        <div class="mb-3">
            <?= $form->field($model, 'username', ['template' =>
                '<div class="input-group field-signupform-username required">
                                                <div class="input-group-prepend ">
                                                    <div class="input-group-text bg-gradient-info font-weight-bold">+998</div>
                                                </div>
                                                {input}
                                            </div>
                                            {error}
                                            '])
                ->widget(\yii\widgets\MaskedInput::className(), [
                    'mask' => 't', // basic year
                    'definitions' => ['t' => [
                        'validator' => '[0-9]',
                        'cardinality' => 9,
                        'prevalidator' => [
                            ['validator' => '[9,8,7,3]', 'cardinality' => 1],
                        ]
                    ]]
                ]) ?>
        </div>
        <label>PAROL</label>
        <div class="mb-3">
            <?= $form->field($model, 'password')->passwordInput()->label(false) ?>
        </div>
        <div class="col-lg-12 text-center">
            <?= Html::submitButton('Kirish', ['class' => 'btn bg-gradient-info w-100 mt-4 mb-0', 'name' => 'login-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
