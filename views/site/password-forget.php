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
<div class="site-password-forget">
    <h1><?= Html::encode($this->title) ?></h1>
        
    <?php $form = ActiveForm::begin([
        'id' => 'password-forget-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'email') ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Reset', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11 register-login-reset-links">
            <a href="<?= Url::toRoute("site/register") ?>">Register</a>
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