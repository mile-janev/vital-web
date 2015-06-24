<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MedicationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="medication-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'rx_number') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'strength') ?>

    <?= $form->field($model, 'strength_measure') ?>

    <?php // echo $form->field($model, 'schedule') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'patient_id') ?>

    <?php // echo $form->field($model, 'prescribed_by_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
