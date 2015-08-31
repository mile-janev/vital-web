<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;

$users = User::find()->all();
?>

<div class="alarm-form-admin">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'patient_id')->dropDownList(ArrayHelper::map($users, 'id', 'name')) ?>
    
    <?= $form->field($model, 'time')->widget(DateTimePicker::classname(), [
                'options' => ['placeholder' => 'Enter event time ...'],
                'pluginOptions' => [
                    'autoclose' => true
                ]
        ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Change', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
