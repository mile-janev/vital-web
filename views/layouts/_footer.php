<?php use yii\helpers\Url; ?>

<?php 
    if ($alarm) {
        \yii\bootstrap\Modal::begin([
            'header'=>'<h4 class="modal-title">Reminder</h4>',
            'id'=>'modal',
            'size'=>'modal_lg',
        ]);
        echo"<div id='modalContent'></div>";
        \yii\bootstrap\Modal::end();
        
        echo $this->render("../alarm/_popup-alarm", [
            "alarm" => $alarm
        ]);
    }
?>

<div id="bar-bottom" class="bar">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 bar-cell">
                <a id="inbox" href="<?= Url::toRoute(["alarm/overview"]) ?>">
                    <img src="<?php echo Url::base(); ?>/images/mail.png" />
                    <span class="text">Inbox</span>
                </a>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 bar-cell">
                <?php if ($alarm) { ?>
                    <a href="#" id="message-box" data-target="#modalInfo" data-toggle="modal">
                        <?php if ($alarm->for_id == $alarm->for_id) { ?>
                            New reminder
                        <?php } else { ?>
                            New message from <?= $alarm->from->role->description . " " . $alarm->from->name ?>
                        <?php } ?>
                    </a>
                <?php } else { ?>
                    <a id="message-box" href="#">No new messages</a>
                <?php } ?>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 bar-cell">
                <a id="done" class="reminder-done" href="#" rel='<?= ($alarm) ? $alarm->id : "#"; ?>' data-img="<?= Url::base(); ?>/images/end_call.png">
                    <img src="<?php echo Url::base(); ?>/images/done.png" />
                    <span class="text">Done</span>
                </a>
            </div>
        </div>
    </div>
</div>