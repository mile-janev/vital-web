<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use zxbodya\yii2\tinymce\TinyMce;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\Role;

/* @var $this yii\web\View */
/* @var $model app\models\Medication */
/* @var $form yii\widgets\ActiveForm */
$doctors = User::findByRole(Role::DOCTOR);
$patients = User::findByRole(Role::PATIENT);
?>

<div class="medication-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rx_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'strength')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'strength_measure')->dropDownList(\app\models\Medication::measurements()) ?>

    <?= $form->field($model, 'schedule')->textarea(['rows' => 6])->widget(TinyMce::className(),
    [
        'fileManager' => [
            'class' => zxbodya\yii2\elfinder\TinyMceElFinder::className(),
            'connectorRoute' => 'el-finder/connector',
        ],
    ]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6])->widget(TinyMce::className(),
    [
        'fileManager' => [
            'class' => zxbodya\yii2\elfinder\TinyMceElFinder::className(),
            'connectorRoute' => 'el-finder/connector',
        ],
    ]) ?>

    <?= $form->field($model, 'patient_id')->dropDownList(ArrayHelper::map($patients, 'id', 'name')) ?>

    <?= $form->field($model, 'prescribed_by_id')->dropDownList(ArrayHelper::map($doctors, 'id', 'name')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
