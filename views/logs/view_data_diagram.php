<?php
use yii\helpers\Html;
use app\models\User;
use app\components\Functions;

$signName = Functions::formatSign($sign);

$this->title = 'Log ' . $signName . ' measurement';
if (User::patientDoctorNurse($user->id, Yii::$app->user->id)) {
    $this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['user/patients']];
    $this->params['breadcrumbs'][] = ['label' => $user->name, 'url' => ['user/patient', 'id' => Yii::$app->user->id]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logs-create container-fluid">

    <h1><?= Html::encode($this->title) ?></h1>

    some chart

</div>
