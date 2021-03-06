<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use app\models\User;
use yii\helpers\ArrayHelper;

$users = User::find()->all();
$signs = \app\models\Sign::find()->all();
?>

<div class="logs-form-admin">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'value')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'created_at')->widget(DateTimePicker::classname(), [
                'options' => ['placeholder' => 'Enter log time ...'],
                'pluginOptions' => [
                    'autoclose' => true
                ]
        ])
        ->hint("*Current time will be logged if you not insert value"); ?>

    <?= $form->field($model, 'sign')->dropDownList(ArrayHelper::map($signs, 'alias', 'name')) ?>
    
    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map($users, 'id', 'name')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
