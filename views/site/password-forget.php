<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Password Forget';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login-register">
    
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-3 hidden-xs">
            &nbsp;
        </div>
        <div class="col-lg-4 col-md-5 col-sm-6 text-center">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
        
    <?php $form = ActiveForm::begin([
        'id' => 'password-forget-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-4 col-md-5 col-sm-6\">{input}</div>\n<div class=\"col-lg-6 col-md-4 col-sm-3\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 col-md-3 col-sm-3 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'email') ?>

    <div class="form-group">
        <div class="col-lg-2 col-md-3 col-sm-3 hidden-xs">
            &nbsp;
        </div>
        <div class="col-lg-4 col-md-5 col-sm-6">
            <?= Html::submitButton('Reset', ['class' => 'btn btn-primary login-register-button', 'name' => 'reset-button']) ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-2 col-md-3 col-sm-3 hidden-xs">
            &nbsp;
        </div>
        <div class="col-lg-1 col-md-2 col-sm-2 col-xs-4">
            <a href="<?= Url::toRoute("site/register") ?>">Register</a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-8 text-right">
            <a href="<?= Url::toRoute("site/login") ?>">Login</a>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <?php if (Yii::$app->session->hasFlash('token_sent')){ ?>
        <div class="form-group flash-successfull">
            <?= Yii::$app->session->getFlash('token_sent'); ?>
        </div>
    <?php } ?>

</div>