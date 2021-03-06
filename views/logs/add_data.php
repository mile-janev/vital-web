<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\bootstrap\Modal;

$this->title = 'Add Data | Healthcare Record System';
?>

<?php 
    Modal::begin([
        'header'=>'<h4 class="modal-title">Log</h4>',
        'id'=>'modal',
        'size'=>'modal_lg',
    ]);
    echo"<div id='modalContent'></div>";
    Modal::end();
?>

<div class="site-add-data container-fluid">
    
    <div class="row">
        <div class="col-xs-6 col-sm-3 block-sign brb bbb">
            <a href="#" rel="<?= Url::toRoute(["logs/log", "sign" => "heart_rate"]) ?>" class='modalLog' title="Heart rate">
                <span class="image-wrapper">
                    <img src="<?= Url::base() ?>/images/heart.png" />
                </span>
                <span class="text">Heart rate</span>
            </a>
        </div>
        <div class="col-xs-6 col-sm-3 block-sign brb bbb">
            <a href="#" rel="<?= Url::toRoute(["logs/log", "sign" => "blood_pressure"]) ?>" class='modalLog' title="Blood pressure">
                <span class="image-wrapper">
                    <img src="<?= Url::base() ?>/images/blood.png" />
                </span>
                <span class="text">Blood pressure</span>
            </a>
        </div>
        <div class="col-xs-6 col-sm-3 block-sign brb bbb">
            <a href="#" rel="<?= Url::toRoute(["logs/log", "sign" => "temperature"]) ?>" class='modalLog' title="Temperature">
                <span class="image-wrapper">
                    <img src="<?= Url::base() ?>/images/temperature.png" />
                </span>
                <span class="text">Temperature</span>
            </a>
        </div>
        <div class="col-xs-6 col-sm-3 block-sign bbb">
            <a href="#" rel="<?= Url::toRoute(["logs/log", "sign" => "weight"]) ?>" class='modalLog' title="Weight">
                <span class="image-wrapper">
                    <img src="<?= Url::base() ?>/images/weight.png" />
                </span>
                <span class="text">Weight</span>
            </a>
        </div>
    </div>
    
    <div class="row hidden-xs">
        <div class="col-xs-6 col-sm-3 block-sign brb">
            <a href="#" rel="<?= Url::toRoute(["logs/log", "sign" => "respiratory_rate"]) ?>" class='modalLog' title="Respiratory rate">
                <span class="image-wrapper">
                    <img src="<?= Url::base() ?>/images/respiratory.png" />
                </span>
                <span class="text">Respiratory rate</span>
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