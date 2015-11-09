<?php
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Call with John Doe | Healthcare Record System';

$jsVars = "var room=".$user->id.";";

$this->registerJs($jsVars, View::POS_HEAD, 'webrtc');
$this->registerJsFile(Url::base() . '/js/webrtc_call.js', [
    'depends' => ['\app\assets\CallAsset'],
    'position' => View::POS_END]
);
?>
<h3 id="title">Start a room</h3>
<form id="createRoom">
    <input id="sessionInput">
    <button type="submit">Create it!</button>
</form>
<p id="subTitle"></p>
<div>
  <button id="screenShareButton"></button>
  (https required for screensharing to work)
</div>
<hr>
<div class="videoContainer">
    <video src="mediastream:https://simplewebrtc.com/60d40d61-b0f7-4b2c-8e77-74f8cdd3c58f" autoplay="autoplay" id="localVideo" style="height: 150px; transform: scaleX(-1);" oncontextmenu="return false;"></video>
    <meter value="-45" style="display: inline-block;" id="localVolume" class="volume" min="-45" max="-20" high="-25" low="-40"></meter>
</div>
<div id="localScreenContainer" class="videoContainer">
</div>
<div id="remotes"></div>
<hr>