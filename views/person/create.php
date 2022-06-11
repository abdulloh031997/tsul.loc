<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Person */

$this->title = "Shaxsiy ma'lumot";
$this->params['breadcrumbs'][] = ['label' => 'Bosh sahifa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
