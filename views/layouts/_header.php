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
                    ['label' => 'Home', 'url' => ['/site/index']],
                    ['label' => 'About', 'url' => ['/site/about']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],
                    [
                        'label' => 'Site',
                        'items' => [
                            ['label' => 'About', 'url' => Url::toRoute("site/about")],
                            ['label' => 'Home', 'url' => Url::toRoute("site/index")],
                        ],
                    ],
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