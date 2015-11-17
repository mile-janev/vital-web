<?php
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Url;
    use kartik\password\PasswordInput;

    $this->title = 'Password Change';
?>

<div class="site-login-register container">

    <div class="row">
        <div class="col-xs-12 text-center">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
        
    <div class="user-form">
        
        <?php $form = ActiveForm::begin([
            'id' => 'password-change-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-4 col-md-6 col-sm-5 col-xs-12\">{input}</div>\n<div class=\"col-lg-4 col-md-3 col-sm-4 col-xs-12\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-4 col-md-3 col-sm-3 col-xs-12 control-label'],
            ],
        ]); ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => 256, 'readonly' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'password_confirm')->passwordInput(['maxlength' => 128]) ?>

        <div class="form-group">
            <div class="col-lg-4 col-md-3 col-sm-3 hidden-xs">
                &nbsp;
            </div>
            <div class="col-lg-4 col-md-6 col-sm-5 col-xs-12">
                <?= Html::submitButton('Reset', ['class' => 'btn btn-primary login-register-button', 'name' => 'login-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
        
    </div>
</div>