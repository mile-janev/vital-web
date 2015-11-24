<?php
    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;
    use yii\helpers\Url;
    use yii\widgets\Breadcrumbs;
?>

<?php
if (count($alarm) > 0) {
    $alText = " (" . count($alarm) . ")";
} else {
    $alText = "";
}

$controllerAction = Yii::$app->controller->id . "/" . Yii::$app->controller->action->id;

$showPatientMenuArray = [
    "medication/patient-history",
    "user/patient-dashboard",
    "alarm/patient-reminders",
    "connection/patient-communication"
];
?>

<?php
NavBar::begin([
    'brandLabel' => "<img src='".Url::base()."/images/uncap.png' alt='UNCAP' />",
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top doctor-menu-nav',
    ],
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right doctor-menu-main'],
    'items' => [
        ['label' => 'Alerts'.$alText, 'url' => ['/alarm/overview']],
        ['label' => 'Dr. ' . $user->name, 'url' => ['/user/view-own']],
        ['label' => 'Settings', 'url' => ['/user/edit']],
        ['label' => 'Log out', 'url' => ['/site/logout']],
    ],
]);

NavBar::end();
?>

<?php if (isset($this->params['breadcrumbs'])) { ?>
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
<?php } else { ?>
    <ul class="breadcrumb">
        <li>Home</li>
    </ul>
<?php } ?>

<?php if (in_array($controllerAction, $showPatientMenuArray)) : ?>
    <ul id="doctor-patient-menu">
        <li><a class="<?= ($controllerAction == "medication/patient-history") ? "active" : "" ?>" href="<?= Url::toRoute(["medication/patient-history"]) ?>">Medical history</a></li>
        <li><a class="<?= ($controllerAction == "user/patient-dashboard") ? "active" : "" ?>" href="<?= Url::toRoute(["user/patient-dashboard"]) ?>">Dashboard</a></li>
        <li><a class="<?= ($controllerAction == "alarm/patient-reminders") ? "active" : "" ?>" href="<?= Url::toRoute(["alarm/patient-reminders"]) ?>">Reminders</a></li>
        <li><a class="<?= ($controllerAction == "connection/patient-communication") ? "active" : "" ?>" href="<?= Url::toRoute(["connection/patient-communication"]) ?>">Communication</a></li>
    </ul>
<?php endif; ?>

<div id="modalSos" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 id="infoModalTitle" class="modal-title">SOS alert</h4>
            </div>

            <div class="modal-body">
                <div id="infoModalContent" class="popupContent">SOS alert is sended. Please wait.</div>
            </div>

            <div class="modal-footer">
                <div id="from-sos" class="hidden"></div>
                <button id="remove-sos" rel="<?= Url::toRoute(["alarm/remove-sos"]) ?>" type="button" class="btn btn-success" data-dismiss="modal"><?= Yii::t("app", "Close") ?></button>
            </div>

        </div>
    </div>
</div>