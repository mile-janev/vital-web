<?php
use yii\helpers\Html;
use app\models\User;
use yii\helpers\Url;
use yii\web\View;
use app\components\Functions;

$jsVars = "";
$jsVars .= "var lines=".$lines."; ";
$jsVars .= "var measure='".$signModel->measure."'; ";
$jsVars .= 'var chartData=' . \yii\helpers\Json::encode($chart) . '; ';

$this->registerJs($jsVars, View::POS_HEAD, 'charts');
$this->registerJsFile(Url::base() . '/js/chart_measurement.js', [
    'depends' => ['\app\assets\ChartsAsset'],
    'position' => View::POS_END]
);

$signName = Functions::formatSign($sign);

$this->title = $signName . ' measurements';
if (User::patientDoctorNurse($user->id, Yii::$app->user->id)) {
    $this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['user/patients']];
    $this->params['breadcrumbs'][] = ['label' => $user->name, 'url' => ['user/patient', 'id' => Yii::$app->user->id]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="measurements-view-chart container">

    <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
        <div class="sub-title">Your last result:</div>
        <?php if (count($logs)) { ?>
            <div class="last-result-time"><?= date("m/d/Y H:i", strtotime($logs[0]->created_at)) ?></div>
            <div class="last-result-value"><span><?= $logs[0]->value . " " . $signModel->measure ?></span></div>
        <?php } else { ?>
            <div class="last-result-value">No logs</div>
        <?php } ?>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
        <div id="chart-measurement"></div>
    </div>

</div>
