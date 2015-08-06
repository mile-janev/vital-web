<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;
use zxbodya\yii2\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model app\models\Medication */

if ($model->isNewRecord) {
    $this->title = 'Add Medication';
} else {
    $this->title = 'Update Medication ' . $model->rx_number;
}

if (User::patientDoctorNurse($patient->id, Yii::$app->user->id)) {
    $this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['user/patients']];
    $this->params['breadcrumbs'][] = ['label' => $patient->name, 'url' => ['user/patient', 'id' => $patient->id]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medication-create-dn">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="medication-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'rx_number')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <div class="form-group field-medication-strength-measure row">
            <div class="col-xs-8">
                <?= $form->field($model, 'strength')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-xs-4">
                <?= $form->field($model, 'strength_measure')->dropDownList(\app\models\Medication::measurements())->label("") ?>
            </div>
        </div>

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
        
        <?= $form->field($model, 'patient_id')->hiddenInput(['value' => $patient->id]); ?>
        <?= $form->field($model, 'prescribed_by_id')->hiddenInput(['value' => $doctorNurse->id]); ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
