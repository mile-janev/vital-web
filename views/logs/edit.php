<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use app\models\User;
use app\components\Functions;

$signName = Functions::formatSign($model->sign);

$this->title = 'Edit: ' . $model->value . " " . $signModel->measure . " - " . date("m/d/Y H:i", strtotime($model->created_at));
if (User::patientDoctorNurse($user->id, Yii::$app->user->id)) {
    $this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['user/patients']];
    $this->params['breadcrumbs'][] = ['label' => $user->name, 'url' => ['user/patient', 'id' => Yii::$app->user->id]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logs-create container">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="logs-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'value')->textInput()->hint("X ".$signModel->measure) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

        <?= $form->field($model, 'created_at')->widget(DateTimePicker::classname(), [
                    'options' => ['placeholder' => 'Enter log time ...'],
                    'pluginOptions' => [
                        'autoclose' => true
                    ]
            ])
            ->hint("*Current time will be logged if you not insert value"); ?>

        <?= $form->field($model, 'sign')->hiddenInput(['value' => $model->sign]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
