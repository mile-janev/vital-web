<?php
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Call between '.$user_called->name.' and '.$user_caller->name.' | Healthcare Record System';

$jsVars = "var room='".$user_called->id."'; ";
$jsVars .= "var myNick='".$user_called->name."'";

$this->registerJs($jsVars, View::POS_HEAD, 'webrtc');
$this->registerJsFile(Url::base() . '/js/webrtc_call.js', [
        'depends' => ['\app\assets\CallAsset'],
        'position' => View::POS_END
    ]
);

$this->params['breadcrumbs'][] = ['label' => 'Communication', 'url' => ['connection/communication']];
$this->params['breadcrumbs'][] = $this->title;

$endCallUrl = Url::toRoute(["connection/call-ended", "id" => $user_called->id], TRUE);
$callDismissedUrl = Url::toRoute(["connection/call-ended", "id" => $user_called->id, "dismissed" => 1], TRUE);
?>

<div class="site-call container-fluid">
    <div class="call-wrapper">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 call-with">
                <h1><?= $user_called->name ?></h1>
                <div class="call-info">In call</div>
                <div id="call-time" class="call-info">00:00</div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 videos">
                <div id="local">
                    <div class="videoContainer">
                        <video src="mediastream:https://simplewebrtc.com/60d40d61-b0f7-4b2c-8e77-74f8cdd3c58f" autoplay="autoplay" id="localVideo" style="height: 150px; transform: scaleX(-1);" oncontextmenu="return false;"></video>
                    </div>
                </div>
                <div id="remotes"></div>
            </div>
        </div>
    </div>
</div>
<div id="call-end" class="hidden"><?= $endCallUrl ?></div>
<a id="call-dismissed" class="hidden" href="<?= $callDismissedUrl ?>"></a>
<div id="caller" class="hidden"><?= Yii::$app->user->id ?></div>
<div id="called" class="hidden"><?= $user_called->id ?></div>
<div id="ajaxCall" class="hidden"><?= Url::toRoute(["connection/ajax-call"]) ?></div>
<div id="ajaxCallAnswer" class="hidden"><?= Url::toRoute(["connection/ajax-call-answer"]) ?></div>
<div id="ajaxCheckCallStatus" class="hidden"><?= Url::toRoute(["connection/ajax-call-status"]) ?></div>