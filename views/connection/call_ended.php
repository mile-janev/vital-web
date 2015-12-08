<?php
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Call between '.$user_called->name.' and '.$user_caller->name;

$this->params['breadcrumbs'][] = ['label' => 'Communication', 'url' => ['connection/communication']];
$this->params['breadcrumbs'][] = $this->title;

if ($user_called->id == Yii::$app->user->id) {
    $id = $user_caller->id;
} else {
    $id = $user_called->id;
}
$callUrl = Url::toRoute(["connection/call", "id" => $id]);
?>

<div class="site-call container-fluid">
    <div class="call-wrapper">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 call-with">
                <h1><?= $user_called->name ?></h1>
                <div class="call-info">Call <?= ($dismissed==1) ? "rejected" : "finished" ?></div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <a id="call-back" href="<?= $callUrl ?>">Call back</a>
            </div>
        </div>
    </div>
</div>