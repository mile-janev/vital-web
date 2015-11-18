<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use app\models\User;

$this->title = 'View Data | Healthcare Record System';
?>

<div class="overview-data container-fluid">
    
    <div class="row">
        <div class="col-xs-6 col-sm-3 block-sign block-sign-splitted brb bbb">
            <div class="overview-chart">
                <a class="data-chart-view left-button" href="<?= Url::toRoute(["logs/view-data-text", "sign" => "heart_rate"]) ?>">Data</a>
                <a class="data-chart-view right-button" href="<?= Url::toRoute(["logs/view-data-chart", "sign" => "heart_rate"]) ?>">Chart</a>
            </div>
            <a class="overview-text" href="<?= Url::toRoute(["logs/view-data-text", "sign" => "heart_rate"]) ?>">
                <span class="image-wrapper">
                    <img src="<?= Url::base() ?>/images/heart.png" />
                </span>
                <span class="text">Heart rate</span>
            </a>
        </div>
        <div class="col-xs-6 col-sm-3 block-sign block-sign-splitted brb bbb">
            <div class="overview-chart">
                <a class="data-chart-view left-button" href="<?= Url::toRoute(["logs/view-data-text", "sign" => "blood_pressure"]) ?>">Data</a>
                <a class="data-chart-view right-button" href="<?= Url::toRoute(["logs/view-data-chart", "sign" => "blood_pressure"]) ?>">Chart</a>
            </div>
            <a class="overview-text" href="<?= Url::toRoute(["logs/view-data-text", "sign" => "blood_pressure"]) ?>">
                <span class="image-wrapper">
                    <img src="<?= Url::base() ?>/images/blood.png" />
                </span>
                <span class="text">Blood pressure</span>
            </a>
        </div>
        <div class="col-xs-6 col-sm-3 block-sign block-sign-splitted brb bbb">
            <div class="overview-chart">
                <a class="data-chart-view left-button" href="<?= Url::toRoute(["logs/view-data-text", "sign" => "temperature"]) ?>">Data</a>
                <a class="data-chart-view right-button" href="<?= Url::toRoute(["logs/view-data-chart", "sign" => "temperature"]) ?>">Chart</a>
            </div>
            <a class="overview-text" href="<?= Url::toRoute(["logs/view-data-text", "sign" => "temperature"]) ?>">
                <span class="image-wrapper">
                    <img src="<?= Url::base() ?>/images/temperature.png" />
                </span>
                <span class="text">Temperature</span>
            </a>
        </div>
        <div class="col-xs-6 col-sm-3 block-sign block-sign-splitted bbb">
            <div class="overview-chart">
                <a class="data-chart-view left-button" href="<?= Url::toRoute(["logs/view-data-text", "sign" => "weight"]) ?>">Data</a>
                <a class="data-chart-view right-button" href="<?= Url::toRoute(["logs/view-data-chart", "sign" => "weight"]) ?>">Chart</a>
            </div>
            <a class="overview-text" href="<?= Url::toRoute(["logs/view-data-text", "sign" => "weight"]) ?>">
                <span class="image-wrapper">
                    <img src="<?= Url::base() ?>/images/weight.png" />
                </span>
                <span class="text">Weight</span>
            </a>
        </div>
    </div>
    
    <div class="row hidden-xs">
        <div class="col-xs-6 col-sm-3 block-sign block-sign-splitted brb">
            <div class="overview-chart">
                <a class="data-chart-view left-button" href="<?= Url::toRoute(["logs/view-data-text", "sign" => "respiratory_rate"]) ?>">Data</a>
                <a class="data-chart-view right-button" href="<?= Url::toRoute(["logs/view-data-chart", "sign" => "respiratory_rate"]) ?>">Chart</a>
            </div>
            <a class="overview-text" href="<?= Url::toRoute(["logs/view-data-text", "sign" => "respiratory_rate"]) ?>">
                <span class="image-wrapper">
                    <img src="<?= Url::base() ?>/images/respiratory.png" />
                </span>
                <span class="text">Respiratory Rate</span>
            </a>
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