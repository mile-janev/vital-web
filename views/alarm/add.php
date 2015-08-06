<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;
use kartik\datetime\DateTimePicker;

$this->title = 'Add Alarm';
if (User::patientDoctorNurse($patient->id, Yii::$app->user->id)) {
    $this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['user/patients']];
    $this->params['breadcrumbs'][] = ['label' => $patient->name, 'url' => ['user/patient', 'id' => $patient->id]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alarm-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alarm-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'time')->widget(DateTimePicker::classname(), [
                'options' => ['placeholder' => 'Enter event time ...'],
                'pluginOptions' => [
                    'autoclose' => true
                ]
        ]); ?>

        <?= $form->field($model, 'patient_id')->hiddenInput(['value' => $patient->id]); ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
