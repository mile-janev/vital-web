<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    $this->title = 'Add Medication';
    $this->params['breadcrumbs'][] = ['label' => 'Medications', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>

<div class="medication-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rx_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group field-medication-strength-measure row">
        <div class="col-xs-8">
            <?= $form->field($model, 'strength')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($model, 'strength_measure')->dropDownList(\app\models\Medication::measurements()) ?>
        </div>
    </div>

    <?= $form->field($model, 'schedule')->textarea(['rows' => 3])?>

    <?= $form->field($model, 'note')->textarea(['rows' => 3]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
