<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login-register container">

    <div class="row">
        <div class="col-xs-12 text-center">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>

    <div class="user-form">

        <?php $form = ActiveForm::begin([
            'id' => 'register-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-4 col-md-6 col-sm-5 col-xs-12\">{input}</div>\n<div class=\"col-lg-4 col-md-3 col-sm-4 col-xs-12\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-4 col-md-3 col-sm-3 col-xs-12 control-label'],
            ],
        ]); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'password_confirm')->passwordInput(['maxlength' => true]) ?>

        <div class="form-group">
            <div class="col-lg-4 col-md-3 col-sm-3 hidden-xs">
                &nbsp;
            </div>
            <div class="col-lg-4 col-md-6 col-sm-5 col-xs-12">
                <?= Html::submitButton('Register', ['class' => 'btn btn-primary login-register-button', 'name' => 'register-button']) ?>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-lg-4 col-md-3 col-sm-3 hidden-xs">
                &nbsp;
            </div>
            <div class="col-lg-1 col-md-3 col-sm-1 col-xs-4">
                <a href="<?= Url::toRoute("site/login") ?>">Login</a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-8 text-right">
                <a href="<?= Url::toRoute("site/password-forget") ?>">Forget your password?</a>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
