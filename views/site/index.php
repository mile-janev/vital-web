<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use app\models\User;

$this->title = 'HRS | Healthcare Record System';

$login = Url::toRoute(['site/login']);
$register = Url::toRoute(['site/register']);
?>
<div class="site-index">

    <div class="body-content">
        
        <?php if (!empty($alarms)) { ?>
            <div class="patient-alarms">
                <?php foreach ($alarms as $alarm) { ?>
                    <div class="row patient-alarm">
                        <div class="col-xs-12">
                            <?php if (User::patientDoctorNurse($user->id, Yii::$app->user->id)) { ?>
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

        <div class="row">
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
                        <div class="link"><a href="<?= Url::toRoute(['logs/detail', 'sign' => 'heart_rate', 'user_id' => $user->id]) ?>">View Measurements</a></div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="tile">
                    <div class="head bg-yellow">
                        <h2><span class="glyphicon glyphicon-tint"></span><span class="heading">Blood Pressure</span></h2>
                    </div>
                    <?php if (Yii::$app->user->isGuest) { ?>
                        <div class="content">
                            <p>Log your blood pressure measurements.</p>
                            <p>Please login to use our services.</p><br />
                            <p>
                                <span class="pull-left"><a href="<?= $login ?>">Log In</a></span>
                                <span class="pull-right"><a href="<?= $register ?>">Register</a></span>
                            </p>
                        </div>
                        <div class="link"><a href="<?= $login ?>">View Measurements</a></div>
                    <?php } else { ?>
                        <div class="content">
                            <p>Last blood pressure measurements.</p>

                            <?php if ($blodPressure) { ?>
                                <ul class="last-signs">
                                    <?php foreach ($blodPressure as $pressure) { ?>
                                        <li>
                                            <span class="log">
                                                <span class="log-value"><strong><?= $pressure->value ?></strong> mmHg</span>, 
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
                        <div class="link"><a href="<?= Url::toRoute(['logs/detail', 'sign' => 'blod_pressure', 'user_id' => $user->id]) ?>">View Measurements</a></div>
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
                            <p>Last temperature measurements.</p>

                            <?php if ($temperature) { ?>
                                <ul class="last-signs">
                                    <?php foreach ($temperature as $temp) { ?>
                                        <li>
                                            <span class="log">
                                                <span class="log-value"><strong><?= $temp->value ?></strong> <sup>o</sup>C</span>, 
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
                        <div class="link"><a href="<?= Url::toRoute(['logs/detail', 'sign' => 'temperature', 'user_id' => $user->id]) ?>">View Measurements</a></div>
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
                            <p>Last weight measurements.</p>

                            <?php if ($weight) { ?>
                                <ul class="last-signs">
                                    <?php foreach ($weight as $w) { ?>
                                        <li>
                                            <span class="log">
                                                <span class="log-value"><strong><?= $w->value ?></strong> kg</span>, 
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
                        <div class="link"><a href="<?= Url::toRoute(['logs/detail', 'sign' => 'weight', 'user_id' => $user->id]) ?>">View Measurements</a></div>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>
</div>
