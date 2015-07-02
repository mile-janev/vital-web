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
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact us', 'url' => ['/site/contact']],
        ['label' => 'Privacy policy', 'url' => ['/site/privacy']],
        !Yii::$app->user->isGuest ? 
        [
            'label' => 'Profile',
            'items' => [
                ['label' => 'Edit', 'url' => Url::toRoute("user/edit")],
            ],
        ] : "",
        Yii::$app->user->isGuest ? ['label' => 'Register', 'url' => ['/site/register']] : "",
        Yii::$app->user->isGuest ?
                ['label' => 'Login', 'url' => ['/site/login']] :
                ['label' => 'Logout (' . Yii::$app->user->identity->email . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']],
    ],
]);
NavBar::end();
?>