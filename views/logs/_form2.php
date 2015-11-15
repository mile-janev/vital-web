<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use kartik\datetime\DateTimePicker;
?>

<div class="logs-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'value')->textInput()->hint("X ".$signModel->measure) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'created_at')->widget(DateTimePicker::classname(), [
                'options' => ['placeholder' => 'Enter log time ...'],
                'pluginOptions' => [
                    'autoclose' => true
                ]
        ])
        ->hint("*Current time will be logged if you not insert value"); ?>

    <?= $form->field($model, 'sign')->hiddenInput(['value' => $sign]) ?>
    <?= $form->field($model, 'user_id')->hiddenInput(['value' => $user_id]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
