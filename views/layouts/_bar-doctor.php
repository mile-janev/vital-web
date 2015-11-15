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
?>

<?php
NavBar::begin([
    'brandLabel' => "<img src='".Url::base()."/images/uncap.png' alt='Healthcare Record System' />",
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top doctor-menu-nav',
    ],
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right doctor-menu-main'],
    'items' => [
        ['label' => 'Alerts'.$alText, 'url' => ['/alarm/overview']],
//        ['label' => 'Messages', 'url' => ['#']],
        ['label' => 'Dr. ' . $user->name, 'url' => ['/user/edit']],
        ['label' => 'Settings', 'url' => Url::toRoute("user/edit")],
        ['label' => 'Log out', 'url' => ['/site/logout']],
    ],
]);

NavBar::end();
?>

<?= Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>

<ul id="doctor-patient-menu">
    <li><a class="<?= ($controllerAction == "medication/patient-history") ? "active" : "" ?>" href="<?= Url::toRoute(["medication/patient-history"]) ?>">Medical history</a></li>
    <li><a class="<?= ($controllerAction == "user/patient-dashboard") ? "active" : "" ?>" href="<?= Url::toRoute(["user/patient-dashboard"]) ?>">Dashboard</a></li>
    <li><a class="<?= ($controllerAction == "alarm/patient-reminders") ? "active" : "" ?>" href="<?= Url::toRoute(["alarm/patient-reminders"]) ?>">Reminders</a></li>
    <li><a class="<?= ($controllerAction == "connection/patient-communication") ? "active" : "" ?>" href="<?= Url::toRoute(["connection/patient-communication"]) ?>">Communication</a></li>
</ul>