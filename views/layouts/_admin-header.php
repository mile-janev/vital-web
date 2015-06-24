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
        [
            'label' => 'Users',
            'items' => [
                ['label' => 'Admin', 'url' => Url::toRoute("user/index")],
                ['label' => 'Connections', 'url' => Url::toRoute("connection/index")],
                ['label' => 'Roles', 'url' => Url::toRoute("role/index")],
            ],
        ],
        ['label' => 'Medications', 'url' => ['/medication/index']],
        [
            'label' => 'Other',
            'items' => [
                ['label' => 'Contact', 'url' => Url::toRoute("site/contact")],
            ],
        ],
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
<div id="admin-separator">&nbsp;</div>