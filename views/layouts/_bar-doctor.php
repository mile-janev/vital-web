<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
//var_dump($alarm);
//exit();
?>

<?php
if (count($alarm) > 0) {
    $alText = " (" . count($alarm) . ")";
} else {
    $alText = "";
}
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
        ['label' => 'Dr. ' . $user->name, 'url' => ['/site/logout']],
        ['label' => 'Settings', 'url' => Url::toRoute("user/patients")],
        ['label' => 'Log out', 'url' => ['/site/logout']],
    ],
]);

NavBar::end();
?>