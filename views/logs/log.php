<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use app\models\User;
use app\components\Functions;

$signName = Functions::formatSign($sign);

$this->title = 'Log ' . $signName;
if (User::patientDoctorNurse($user->id, Yii::$app->user->id)) {
    $this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['user/patients']];
    $this->params['breadcrumbs'][] = ['label' => $user->name, 'url' => ['user/patient', 'id' => Yii::$app->user->id]];
}
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
if ($signModel->alias == "blood_pressure") {
    $hintAdditional = " <span class='hint-additional'>(systolic/diastolic separate with '/')</span>";
} else {
    $hintAdditional = "";
}
?>
<div class="logs-log logs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'value')->textInput()->hint("X ".$signModel->measure.$hintAdditional) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'created_at')->widget(DateTimePicker::classname(), [
                'options' => ['placeholder' => 'Enter log time ...'],
                'pluginOptions' => [
                    'autoclose' => true
                ]
        ])
        ->hint("*Current time will be logged if you not insert value"); ?>

    <?= $form->field($model, 'sign')->hiddenInput(['value' => $sign]) ?>

    <div class="form-group">
        <?= Html::submitButton('Log', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
