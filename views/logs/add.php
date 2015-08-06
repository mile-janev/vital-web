<?php
use yii\helpers\Html;
use app\models\User;
use app\components\Functions;

$signName = Functions::formatSign($sign);

$this->title = 'Log ' . $signName;
if (User::patientDoctorNurse($user->id, Yii::$app->user->id)) {
    $this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['user/patients']];
    $this->params['breadcrumbs'][] = ['label' => $user->name, 'url' => ['user/patient', 'id' => $user_id]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form2', [
        'model' => $model,
        'user_id' => $user_id,
        'sign' => $sign,
        'signModel' => $signModel,
        'user' => $user
    ]) ?>

</div>
