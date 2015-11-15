<?php
    use yii\helpers\Html;
    use yii\widgets\DetailView;
    use yii\helpers\Url;
    use app\models\User;
    use yii\web\View;

    $this->title = $model->name;
    $this->params['breadcrumbs'][] = ['label' => 'My patients', 'url' => ['patients']];
    $this->params['breadcrumbs'][] = $this->title;
    
    $jsVars = "";
    $jsVars .= "var measureHeart='".$signHeartModel->measure."'; ";
    $jsVars .= 'var chartDataHeart=' . \yii\helpers\Json::encode($chartHeart) . '; ';

    $this->registerJs($jsVars, View::POS_HEAD, 'charts');
    $this->registerJsFile(Url::base() . '/js/chart_measurement_doctor.js', [
        'depends' => ['\app\assets\ChartsAsset'],
        'position' => View::POS_END]
    );
?>

<?php
    if ($model->image) {
        $avatar = Url::base(TRUE) . "/pics/".$model->image;
    } else {
        $avatar = Url::base(TRUE) . "/images/user.png";
    }
?>

<div class="doctor-patient-dashboard container-fluid">

    <div class="row">
        <div class="col-xs-6 col-sm-4 block-sign block-sign-splitted brb bbb">
            <h2>Heart rate</h2>
            <div id="dp-chart-heart" class="doctor-patient-chart"></div>
        </div>
        <div class="col-xs-6 col-sm-4 block-sign block-sign-splitted brb bbb">
            <h2>Blood pressure</h2>
            <div id="dp-chart-pressure" class="doctor-patient-chart"></div>
        </div>
        <div class="col-xs-6 col-sm-4 block-sign block-sign-splitted bbb">
            <h2>Temperature</h2>
            <div id="dp-chart-temperature" class="doctor-patient-chart"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-4 block-sign block-sign-splitted brb">
            <h2>Respiratory rate</h2>
            <div id="dp-chart-respiratory" class="doctor-patient-chart"></div>
        </div>
        <div class="col-xs-6 col-sm-4 block-sign block-sign-splitted brb">
            <h2>Weight</h2>
            <div id="dp-chart-weight" class="doctor-patient-chart"></div>
        </div>
        <div class="col-xs-6 col-sm-4 block-sign empty-sign hidden-xs">
            &nbsp;
        </div>
    </div>
    
</div>
