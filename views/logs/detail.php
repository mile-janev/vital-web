<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\models\User;
use app\components\Functions;

$signName = Functions::formatSign($sign);

$this->title = $user->name . " " . $signName;
if (User::patientDoctorNurse($user->id, Yii::$app->user->id)) {
    $this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['user/patients']];
    $this->params['breadcrumbs'][] = ['label' => $user->name, 'url' => ['user/patient', 'id' => $user_id]];
}
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="logs">
    
    <h1><?= $this->title ?></h1>
    
    <div class="row patient-add-medication">
        <div class="col-xs-12">
            <?= Html::a("Add Measurement", Url::toRoute(["logs/add", "sign" => $sign, "user_id" => $user_id]), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    
    <?php if ($logs) { ?>
        <div class="logs-list">
            <?php for ($i=0; $i<count($logs); $i++) { ?>
                <div class="row log-row">
                    <div class="col-xs-12">
                        <div class="row-inside <?= (($i+1)%2!=0) ? "odd" : "even" ?>">
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <?= $logs[$i]->created_at ?>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 log-value">
                                <?= $signName . ": " . $logs[$i]->value . " " . $signModel->measure ?>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <?= $logs[$i]->description ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        No logs
    <?php } ?>
    
</div>