<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use app\models\User;

$this->title = 'HRS | Healthcare Record System';
?>

<div class="site-index container-fluid">
    
    <div class="row">
        <div class="col-xs-6 block brw bbw">
            <a href="<?= Url::toRoute(["connection/overview"]) ?>">
                <span class="text">Contacts</span>
                <span class="image-wrapper">
                    <img src="<?= Url::base() ?>/images/contact.png" />
                </span>
            </a>
        </div>
        <div class="col-xs-6 block bbw">
            <a href="<?= Url::toRoute(["alarm/overview"]) ?>">
                <span class="text">Reminders</span>
                <span class="image-wrapper">
                    <img src="<?= Url::base() ?>/images/reminder.png" />
                </span>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6 block brw bbw">
            <a href="<?= Url::toRoute(["logs/overview"]) ?>">
                <span class="text">Biosignals</span>
                <span class="image-wrapper">
                    <img src="<?= Url::base() ?>/images/biosignal.png" />
                </span>
            </a>
        </div>
        <div class="col-xs-6 block bbw">
            <a href="<?= Url::toRoute(["medication/overview"]) ?>">
                <span class="text">Medical records</span>
                <span class="image-wrapper">
                    <img src="<?= Url::base() ?>/images/record.png" />
                </span>
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-6 block brw">
            <a href="<?= Url::toRoute(["logs/add-data"]) ?>">
                <span class="text">Add data</span>
                <span class="image-wrapper">
                    <img src="<?= Url::base() ?>/images/add_data.png" />
                </span>
            </a>
        </div>
        <div class="col-xs-6 block">
            <a href="<?= Url::toRoute(["connection/communication"]) ?>">
                <span class="text">Communication</span>
                <span class="image-wrapper">
                    <img src="<?= Url::base() ?>/images/communication.png" />
                </span>
            </a>
        </div>
    </div>
    
</div>