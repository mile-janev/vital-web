<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['patients']];
$this->params['breadcrumbs'][] = $this->title;

$login = Url::toRoute(['site/login']);
$register = Url::toRoute(['site/register']);
?>

<?php
    if ($model->image) {
        $avatar = "/pics/".$model->image;
    } else {
        $avatar = "/images/user.png";
    }
?>

<div class="patient-view">

    <div class="row patient-header">
        <div class="col-xs-12">
            <h1 class="pull-left"><?= Html::encode($this->title) ?></h1>
            <img class="pull-right" src="<?= $avatar ?>" width="50" />
        </div>
    </div>
    
<?php if (User::patientDoctorNurse($model->id, Yii::$app->user->id)) { ?>
    <div class="row patient-add-medication">
        <div class="col-xs-12">
            <?= Html::a("Add Medication", Url::toRoute(["medication/add-medication", "dn_id" => Yii::$app->user->id, "patient_id" => $model->id]), ['class' => 'btn btn-success']) ?>
            <?= Html::a("Add Alarm", Url::toRoute(["alarm/add", "patient_id" => $model->id]), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
<?php } ?>
    
<?php if (!empty($alarms)) { ?>
    <div class="patient-alarms">
        <?php foreach ($alarms as $alarm) { ?>
            <div class="row patient-alarm">
                <div class="col-xs-12">
                    <?php if (User::patientDoctorNurse($model->id, Yii::$app->user->id)) { ?>
                        <a title="Update" class="alarm-link" href="<?= Url::toRoute(["alarm/change", "id" => $alarm->id]) ?>">
                           <span class="alarm">
                               (<?= date("H:i:s Y-m-d", strtotime($alarm->time)) ?>)
                               <?= $alarm->title ?>
                           </span>
                        </a>
                    <?php } else { ?>
                        <span class="alarm">
                            (<?= date("H:m:s Y-m-d", strtotime($alarm->time)) ?>)
                            <?= $alarm->title ?>
                        </span>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>
    
    <div class="row patient-signs">
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="tile">
                <div class="head bg-red">
                    <h2><span class="glyphicon glyphicon-heart"></span><span class="heading">Heart rate</span></h2>
                </div>
                <div class="content">
                    <p>Last heart rate measurements:</p>
                    
                    <?php if ($heartRate) { ?>
                        <ul class="last-signs">
                            <?php foreach ($heartRate as $rate) { ?>
                                <li>
                                    <span class="log">
                                        <span class="log-value"><strong><?= $rate->value ?></strong> beats/min</span>, 
                                        <span class="log-time"><?= $rate->created_at ?></span>
                                    </span>
                                    
                                    <?php if ($rate->description) { ?><span class="log-description">(<?= $rate->description ?>)</span><?php } ?>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } else { ?>
                        No logs
                    <?php } ?>
                </div>
                <div class="link"><a href="<?= Url::toRoute(['sign/detail', 'alias' => 'heart']) ?>">View Measurements</a></div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="tile">
                <div class="head bg-yellow">
                    <h2><span class="glyphicon glyphicon-tint"></span><span class="heading">Blod Pressure</span></h2>
                </div>
                <div class="content">
                    <p>Last blod pressure measurements.</p>
                    
                    <?php if ($blodPressure) { ?>
                        <ul class="last-signs">
                            <?php foreach ($blodPressure as $pressure) { ?>
                                <li>
                                    <span class="log">
                                        <span class="log-value"><strong><?= $pressure->value ?></strong></span>, 
                                        <span class="log-time"><?= $pressure->created_at ?></span>
                                    </span>
                                    <?php if ($pressure->description) { ?><span class="log-description">(<?= $pressure->description ?>)</span><?php } ?>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } else { ?>
                        No logs
                    <?php } ?>
                </div>
                <div class="link"><a href="<?= Url::toRoute(['sign/detail', 'alias' => 'pressure']) ?>">View Measurements</a></div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="tile">
                <div class="head bg-green">
                    <h2><span class="glyphicon glyphicon-fire"></span><span class="heading">Temperature</span></h2>
                </div>
                <div class="content">
                    <p>Last temperature measurements.</p>
                    
                    <?php if ($temperature) { ?>
                        <ul class="last-signs">
                            <?php foreach ($temperature as $temp) { ?>
                                <li>
                                    <span class="log">
                                        <span class="log-value"><strong><?= $temp->value ?></strong><sup>o</sup>C</span>, 
                                        <span class="log-time"><?= $temp->created_at ?></span>
                                    </span>
                                    <?php if ($temp->description) { ?><span class="log-description">(<?= $temp->description ?>)</span><?php } ?>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } else { ?>
                        No logs
                    <?php } ?>
                </div>
                <div class="link"><a href="<?= Url::toRoute(['sign/detail', 'alias' => 'temperature']) ?>">View Measurements</a></div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="tile">
                <div class="head bg-blue">
                    <h2><span class="glyphicon glyphicon-dashboard"></span><span class="heading">Weight</span></h2>
                </div>
                <div class="content">
                    <p>Last weight measurements.</p>
                    
                    <?php if ($weight) { ?>
                        <ul class="last-signs">
                            <?php foreach ($weight as $w) { ?>
                                <li>
                                    <span class="log">
                                        <span class="log-value"><strong><?= $w->value ?></strong>kg</span>, 
                                        <span class="log-time"><?= $w->created_at ?></span>
                                    </span>
                                    <?php if ($w->description) { ?><span class="log-description">(<?= $w->description ?>)</span><?php } ?>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } else { ?>
                        No logs
                    <?php } ?>
                </div>
                <div class="link"><a href="<?= Url::toRoute(['sign/detail', 'alias' => 'weight']) ?>">View Measurements</a></div>
        </div>
    </div>
    
<?php if (count($model->medications) > 0) { ?>
    <div class="patient-medications">
        <div class="col-xs-12">
            <h4>Patient medications</h4>
        </div>
        <?php foreach ($model->medications as $medication) { ?>
            <div class="col-xs-12">
                <div class="patient-medication">
                    <div class="pm-header">
                        <span class="rx-number"><strong>RX:</strong> <?= $medication->rx_number ?></span>
                        <span class="name"><strong><?= $medication->name ?></strong></span>
                    </div>
                    <div class="pm-content">
                        <div class="doze"><strong>Doze:</strong> <strong><?= $medication->strength . " " . $medication->strength_measure ?></strong></div>
                        <div class="schedule"><strong><?= $medication->schedule ?></strong></div>
                        <div class="note"><?= $medication->note ?></div>
                        <?php if (User::patientDoctorNurse($model->id, Yii::$app->user->id)) { ?>
                            <?= Html::a("Update", Url::toRoute(["medication/update-medication", "id" => $medication->id])) ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>
    
<?php if (count($model->patientConnection) > 0) { ?>
<div class="patient-connections">
    <div class="col-xs-12">
        <h4>Patient connections</h4>
    </div>
    <?php foreach ($model->patientConnection as $con) { ?>
        <div class="col-xs-12">
            <ul class="patient-connection">
                <li>
                    <a href="<?php echo Url::toRoute(["user/view", "id" => $con->user->id]) ?>"><?php echo $con->user->name ?></a>,
                    <a href="mailto: <?php echo $con->user->email ?>"><?php echo $con->user->email ?></a>,
                    <span><?php echo $con->user->role->description ?></span>
                </li>
            </ul>
        </div>
    <?php } ?>
</div>
<?php } ?>

</div>
