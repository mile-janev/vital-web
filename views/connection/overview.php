<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use app\models\User;

$this->title = 'Contacts | Healthcare Record System';

var_dump($user->patientConnection);
exit();
?>

<div class="site-contacts container-fluid">
    
    <div class="row">
        <div class="col-xs-6 col-sm-3 block-sign block-sign-splitted brb bbb">
            <a class="overview-chart" href="<?= Url::toRoute(["logs/view-data-chart", "sign" => "heart_rate"]) ?>">
                <img src="<?= Url::base() ?>/images/chart.png" />
            </a>
            <a class="overview-text" href="<?= Url::toRoute(["logs/view-data-text", "sign" => "heart_rate"]) ?>">
                <span class="image-wrapper">
                    <img src="<?= Url::base() ?>/images/heart.png" />
                </span>
                <span class="text">Heart rate</span>
            </a>
        </div>
        <div class="col-xs-6 col-sm-3 block-sign block-sign-splitted brb bbb">
            <a class="overview-chart" href="<?= Url::toRoute(["logs/view-data-chart", "sign" => "blod_pressure"]) ?>">
                <img src="<?= Url::base() ?>/images/chart.png" />
            </a>
            <a class="overview-text" href="<?= Url::toRoute(["logs/view-data-text", "sign" => "blod_pressure"]) ?>">
                <span class="image-wrapper">
                    <img src="<?= Url::base() ?>/images/blood.png" />
                </span>
                <span class="text">Blood pressure</span>
            </a>
        </div>
        <div class="col-xs-6 col-sm-3 block-sign block-sign-splitted brb bbb">
            <a class="overview-chart" href="<?= Url::toRoute(["logs/view-data-chart", "sign" => "temperature"]) ?>">
                <img src="<?= Url::base() ?>/images/chart.png" />
            </a>
            <a class="overview-text" href="<?= Url::toRoute(["logs/view-data-text", "sign" => "temperature"]) ?>">
                <span class="image-wrapper">
                    <img src="<?= Url::base() ?>/images/temperature.png" />
                </span>
                <span class="text">Temperature</span>
            </a>
        </div>
        <div class="col-xs-6 col-sm-3 block-sign block-sign-splitted bbb">
            <a class="overview-chart" href="<?= Url::toRoute(["logs/view-data-chart", "sign" => "weight"]) ?>">
                <img src="<?= Url::base() ?>/images/chart.png" />
            </a>
            <a class="overview-text" href="<?= Url::toRoute(["logs/view-data-text", "sign" => "weight"]) ?>">
                <span class="image-wrapper">
                    <img src="<?= Url::base() ?>/images/weight.png" />
                </span>
                <span class="text">Weight</span>
            </a>
        </div>
    </div>
    
    <div class="row hidden-xs">
        <div class="col-xs-6 col-sm-3 block-sign empty-sign brb">
            <a href="#">&nbsp;</a>
        </div>
        <div class="col-xs-6 col-sm-3 block-sign empty-sign brb">
            <a href="#">&nbsp;</a>
        </div>
        <div class="col-xs-6 col-sm-3 block-sign empty-sign brb">
            <a href="#">&nbsp;</a>
        </div>
        <div class="col-xs-6 col-sm-3 block-sign empty-sign">
            <a href="#">&nbsp;</a>
        </div>
    </div>
    
</div>