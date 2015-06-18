<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\password\PasswordInput;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Password Change';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clearspace"></div>
<div class="container">
    <div class="site-password">
        
        <?php $form = ActiveForm::begin([
            'id' => 'password-change-form',
            'options' => ['class' => 'form-vertical'],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-12 control-label'],
            ],
        ]); ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => 256, 'readonly' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'password_confirm')->passwordInput(['maxlength' => 128]) ?>

        <div class="form-group">
            <div class="col-lg-12">
                <?= Html::submitButton('Reset', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
        
    </div>
</div>