<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;
use app\models\Role;
use yii\helpers\ArrayHelper;

$this->title = 'Add Connection';

$users = User::findUsersWithoutConnections();
?>
<div class="connection-create">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map($users, 'id', 'name')) ?>

    <div class="form-group">
        <?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
