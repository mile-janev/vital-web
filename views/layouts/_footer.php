<?php
    use yii\helpers\Url;
//    var_dump($alarm->from->name);
//    exit();
?>

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
            <div class="col-sm-2 col-xs-12 bar-cell">
                <a id="inbox" href="#">
                    <img src="<?php echo Url::base(); ?>/images/mail.png" />
                    <span class="text">Inbox</span>
                </a>
            </div>
            <div class="col-sm-8 col-xs-12 bar-cell">
                <?php if ($alarm) { ?>
                    <a href="#" id="message-box" data-target="#modalInfo" data-toggle="modal">
                        <?php if ($alarm->patient_id == $alarm->from_id) { ?>
                            New own reminder
                        <?php } else { ?>
                            New message from <?= $alarm->from->role->description . " " . $alarm->from->name ?>
                        <?php } ?>
                    </a>
                <?php } else { ?>
                    <a id="message-box" href="#">No new messages</a>
                <?php } ?>
            </div>
            <div class="col-sm-2 col-xs-12 bar-cell">
                <a id="done" href="#">
                    <img src="<?php echo Url::base(); ?>/images/done.png" />
                    <span class="text">Done</span>
                </a>
            </div>
        </div>
    </div>
</div>