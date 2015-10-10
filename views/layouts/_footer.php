<?php
    use yii\helpers\Url;
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
                <a id="message-box" href="#">No new messages</a>
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