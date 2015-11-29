<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

$this->title = 'Add Reminder | Healthcare Record System';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alarm-create alarm-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => 'Enter event time ...'],
            'pluginOptions' => [
                'autoclose' => true
            ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
