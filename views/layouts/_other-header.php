<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php
NavBar::begin([
    'brandLabel' => 'Healthcare Record System',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top main-menu-nav',
    ],
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right main-menu'],
    'items' => [
        ['label' => 'Connections', 'url' => Url::toRoute("user/patients")],
        [
            'label' => 'Profile',
            'items' => [
                ['label' => 'Edit', 'url' => Url::toRoute("user/edit")],
            ],
        ],
        ['label' => 'Logout (' . Yii::$app->user->identity->email . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']],
    ],
]);

NavBar::end();
?>