<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'HRS | Healthcare Record System';

$login = Url::toRoute(['site/login']);
$register = Url::toRoute(['site/register']);
?>
<div class="site-index">

    <div class="body-content">

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

    </div>
</div>
