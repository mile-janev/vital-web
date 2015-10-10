<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use app\models\User;

$this->title = 'View Data | Healthcare Record System';
?>

<div class="site-add-data container-fluid">
    
    <div class="row">
        <div class="col-xs-6 col-sm-3 block-sign brb bbb">
            <a href="<?= Url::toRoute(["logs/view", "sign" => "heart_rate", "user_id" => Yii::$app->user->id]) ?>">
                <span class="image-wrapper">
                    <img src="<?= Url::base() ?>/images/heart.png" />
                </span>
                <span class="text">Heart rate</span>
            </a>
        </div>
        <div class="col-xs-6 col-sm-3 block-sign brb bbb">
            <a href="<?= Url::toRoute(["logs/view", "sign" => "blod_pressure", "user_id" => Yii::$app->user->id]) ?>">
                <span class="image-wrapper">
                    <img src="<?= Url::base() ?>/images/blood.png" />
                </span>
                <span class="text">Blood pressure</span>
            </a>
        </div>
        <div class="col-xs-6 col-sm-3 block-sign brb bbb">
            <a href="<?= Url::toRoute(["logs/view", "sign" => "temperature", "user_id" => Yii::$app->user->id]) ?>">
                <span class="image-wrapper">
                    <img src="<?= Url::base() ?>/images/temperature.png" />
                </span>
                <span class="text">Temperature</span>
            </a>
        </div>
        <div class="col-xs-6 col-sm-3 block-sign bbb">
            <a href="<?= Url::toRoute(["logs/view", "sign" => "weight", "user_id" => Yii::$app->user->id]) ?>">
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