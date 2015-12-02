<?php
    use yii\helpers\Html;
    use app\models\User;
    use app\components\Functions;
    use yii\bootstrap\ActiveForm;

    $this->title = $user->name;
    $mews = app\models\User::mews($user->id);
    $this->params['breadcrumbs'][] = ['label' => 'My patients', 'url' => ['site/index']];
    $this->params['breadcrumbs'][] = $this->title . " (" . $mews . ")";
?>

<div class="patient-mews container">
    
    <div class="row">
        <div class="col-xs-12 text-center">
            <h1 id="mews-title">Calculate MEWS for <?= Html::encode($this->title) ?></h1>
        </div>
    </div>

    <?php $form = ActiveForm::begin(['id' => 'mews-form', 'action' => \yii\helpers\Url::toRoute(['user/mews-validate'])]);?>

        <?= $form->field($model, 'patient')->hiddenInput(['value' => $user->id])->label(false) ?>
    
    <div class="row">
        
        <div class="col-xs-12 col-sm-4">
            <?= $form->field($model, 'systolic')->textInput() ?>
        </div>
        
        <div class="col-xs-12 col-sm-4">
            <?= $form->field($model, 'heart')->textInput() ?>
        </div>
    
        <div class="col-xs-12 col-sm-4">
            <?= $form->field($model, 'respiratory')->textInput() ?>
        </div>
    </div>
    
    <div class="row">
        
        <div class="col-xs-12 col-sm-4">
            <?= $form->field($model, 'temperature')->textInput() ?>
        </div>

        <div class="col-xs-12 col-sm-4">
            <?= $form->field($model, 'avpu')->dropDownList(Functions::avpu()) ?>
        </div>
        
        <div class="col-xs-12 col-sm-4">
            <input id="mews-button" class="btn btn-primary" type="submit" name="Calculate" value="Calculate" />
            <div id="mews-save-wrapper">
                <a id="mews-save" href="<?= \yii\helpers\Url::toRoute(["user/mews-save"]) ?>">Save Measurements</a>
                <div id="mews-saved">Measurements Saved</div>
            </div>
        </div>
        
    </div>
    
    <div class="row">
        <div class="col-xs-12">
            <div id="mews-value">0</div>
        </div>
    </div>
    
    <?php ActiveForm::end(); ?>
    
</div>
