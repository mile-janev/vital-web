<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;
use app\models\Role;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Connection */
/* @var $form yii\widgets\ActiveForm */
$users = User::findByRole([Role::DOCTOR, Role::NURSE, ROLE::FAMILY]);
$patients = User::findByRole(Role::PATIENT);
?>

<div class="connection-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map($users, 'id', 'name')) ?>

    <?= $form->field($model, 'patient_id')->dropDownList(ArrayHelper::map($patients, 'id', 'name')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
