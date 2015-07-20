<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = "Patient: " . $model->name;
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
        </div>
    </div>
<?php } ?>
    
    <div class="row patient-alarm">
        <div class="col-xs-12">
            <a class="alarm-link" href="#">
                <span class="alarm">
                    Patient next alarm here. Something like, "Next pill in 6pm". This is also link to all alarms.
                </span>
            </a>
        </div>
    </div>
    
    <div class="row patient-signs">
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="tile">
                <div class="head bg-red">
                    <h2><span class="glyphicon glyphicon-heart"></span><span class="heading">Heart rate</span></h2>
                </div>
                <?php if (Yii::$app->user->isGuest) { ?>
                    <div class="content">
                        <p>Log your heart rate measurements.</p>
                        <p>Please login to use our services.</p><br />
                        <p>
                            <span class="pull-left"><a href="<?= $login ?>">Log In</a></span>
                            <span class="pull-right"><a href="<?= $register ?>">Register</a></span>
                        </p>
                    </div>
                    <div class="link"><a href="<?= $login ?>">View Measurements</a></div>
                <?php } else { ?>
                    <div class="content">
                        <p>Your heart rate measurements.</p>
                        <p>Last log: 15 beats/min</p><br />
                        <p>Note 1: Drink your pill at 6pm.</p>
                        <p>Note 2: Drink your pill at 6pm.</p>
                    </div>
                    <div class="link"><a href="<?= Url::toRoute(['sign/detail', 'alias' => 'heart']) ?>">View Measurements</a></div>
                <?php } ?>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="tile">
                <div class="head bg-yellow">
                    <h2><span class="glyphicon glyphicon-tint"></span><span class="heading">Blod Pressure</span></h2>
                </div>
                <?php if (Yii::$app->user->isGuest) { ?>
                    <div class="content">
                        <p>Log your blod pressure measurements.</p>
                        <p>Please login to use our services.</p><br />
                        <p>
                            <span class="pull-left"><a href="<?= $login ?>">Log In</a></span>
                            <span class="pull-right"><a href="<?= $register ?>">Register</a></span>
                        </p>
                    </div>
                    <div class="link"><a href="<?= $login ?>">View Measurements</a></div>
                <?php } else { ?>
                    <div class="content">
                        <p>Your blod pressure measurements.</p>
                        <p>Last log: 120/80</p><br />
                        <p>Note 1: Drink your pill at 6pm.</p>
                        <p>Note 2: Drink your pill at 6pm.</p>
                    </div>
                    <div class="link"><a href="<?= Url::toRoute(['sign/detail', 'alias' => 'pressure']) ?>">View Measurements</a></div>
                <?php } ?>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="tile">
                <div class="head bg-green">
                    <h2><span class="glyphicon glyphicon-fire"></span><span class="heading">Temperature</span></h2>
                </div>
                <?php if (Yii::$app->user->isGuest) { ?>
                    <div class="content">
                        <p>Log your temperature measurements.</p>
                        <p>Please login to use our services.</p><br />
                        <p>
                            <span class="pull-left"><a href="<?= $login ?>">Log In</a></span>
                            <span class="pull-right"><a href="<?= $register ?>">Register</a></span>
                        </p>
                    </div>
                    <div class="link"><a href="<?= $login ?>">View Measurements</a></div>
                <?php } else { ?>
                    <div class="content">
                        <p>Your temperature measurements.</p>
                        <p>Last log: 36.6<sup>o</sup>C</p><br />
                        <p>Note 1: Drink your pill at 6pm.</p>
                        <p>Note 2: Drink your pill at 6pm.</p>
                    </div>
                    <div class="link"><a href="<?= Url::toRoute(['sign/detail', 'alias' => 'temperature']) ?>">View Measurements</a></div>
                <?php } ?>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="tile">
                <div class="head bg-blue">
                    <h2><span class="glyphicon glyphicon-dashboard"></span><span class="heading">Weight</span></h2>
                </div>
                <?php if (Yii::$app->user->isGuest) { ?>
                    <div class="content">
                        <p>Log your weight measurements.</p>
                        <p>Please login to use our services.</p><br />
                        <p>
                            <span class="pull-left"><a href="<?= $login ?>">Log In</a></span>
                            <span class="pull-right"><a href="<?= $register ?>">Register</a></span>
                        </p>
                    </div>
                    <div class="link"><a href="<?= $login ?>">View Measurements</a></div>
                <?php } else { ?>
                    <div class="content">
                        <p>Your weight measurements.</p>
                        <p>Last log: 62kg</p><br />
                        <p>Note 1: Drink your pill at 6pm.</p>
                        <p>Note 2: Drink your pill at 6pm.</p>
                    </div>
                    <div class="link"><a href="<?= Url::toRoute(['sign/detail', 'alias' => 'weight']) ?>">View Measurements</a></div>
                <?php } ?>
            </div>
        </div>
    </div>
    
<?php if (count($model->medications) > 0) { ?>
    <div class="row patient-medications">
        <?php foreach ($model->medications as $medication) { ?>
            <div class="col-xs-12">
                All medications for this patient listed here.
            </div>
        <?php } ?>
    </div>
<?php } ?>
    
<?php if (count($model->patientConnection) > 0) { ?>
<div class="row patient-connections">
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
