<?php
    use yii\helpers\Html;
    use yii\widgets\DetailView;
    use yii\helpers\Url;
    use app\models\User;
    use yii\web\View;
    use yii\helpers\Json;
    
    $mews = User::mews($user->id);

    $this->title = $model->name;
    $this->params['breadcrumbs'][] = ['label' => 'My patients', 'url' => ['site/index']];
    $this->params['breadcrumbs'][] = $this->title . " (" . $mews . ")";
    
    $jsVars = "";
    $jsVars .= "var measureHeart='".$signHeartModel->measure."'; ";
    $jsVars .= 'var chartDataHeart=' . Json::encode($chartHeart) . '; ';
    $jsVars .= "var measureTemp='".$signTempModel->measure."'; ";
    $jsVars .= 'var chartDataTemp=' . Json::encode($chartTemp) . '; ';
    $jsVars .= "var measurePressure='".$signPressureModel->measure."'; ";
    $jsVars .= 'var chartDataPressure=' . Json::encode($chartPressure) . '; ';
    $jsVars .= "var measureRespiratory='".$signRespiratoryModel->measure."'; ";
    $jsVars .= 'var chartDataRespiratory=' . Json::encode($chartRespiratory) . '; ';
    $jsVars .= "var measureWeight='".$signWeightModel->measure."'; ";
    $jsVars .= 'var chartDataWeight=' . Json::encode($chartWeight) . '; ';

    $this->registerJs($jsVars, View::POS_HEAD, 'charts');
    $this->registerJsFile(Url::base() . '/js/chart_measurement_doctor.js', [
        'depends' => ['\app\assets\ChartsAsset'],
        'position' => View::POS_END]
    );
?>

<div class="doctor-patient-dashboard container-fluid">

    <div class="row">
        <div class="col-xs-6 col-sm-4 block-sign block-sign-splitted brb bbb">
            <h2><a href="<?= Url::toRoute(["logs/patient-view-data-text", "sign" => "heart_rate", "id" => $user->id]) ?>">Heart rate</a></h2>
            <div id="dp-chart-heart" class="doctor-patient-chart"></div>
        </div>
        <div class="col-xs-6 col-sm-4 block-sign block-sign-splitted brb bbb">
            <h2><a href="<?= Url::toRoute(["logs/patient-view-data-text", "sign" => "blood_pressure", "id" => $user->id]) ?>">Blood pressure</a></h2>
            <div id="dp-chart-pressure" class="doctor-patient-chart"></div>
        </div>
        <div class="col-xs-6 col-sm-4 block-sign block-sign-splitted bbb">
            <h2><a href="<?= Url::toRoute(["logs/patient-view-data-text", "sign" => "temperature", "id" => $user->id]) ?>">Temperature</a></h2>
            <div id="dp-chart-temp" class="doctor-patient-chart"></div>
        </div>
        <div class="col-xs-6 col-sm-4 block-sign block-sign-splitted brb">
            <h2><a href="<?= Url::toRoute(["logs/patient-view-data-text", "sign" => "respiratory_rate", "id" => $user->id]) ?>">Respiratory rate</a></h2>
            <div id="dp-chart-respiratory" class="doctor-patient-chart"></div>
        </div>
        <div class="col-xs-6 col-sm-4 block-sign block-sign-splitted brb">
            <h2><a href="<?= Url::toRoute(["logs/patient-view-data-text", "sign" => "weight", "id" => $user->id]) ?>">Weight</a></h2>
            <div id="dp-chart-weight" class="doctor-patient-chart"></div>
        </div>
        <div class="col-xs-6 col-sm-4 block-sign hidden-xs">
            &nbsp;
        </div>
    </div>
    
</div>
