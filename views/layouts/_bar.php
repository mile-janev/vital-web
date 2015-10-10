<?php
    use yii\helpers\Url;
?>

<div id="bar-top" class="bar">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 col-xs-6 bar-cell bar-cell-half">
                <a id="home" href="<?= Url::base(TRUE) ?>">
                    <span class="image-wrapper">
                        <img src="<?= Url::base() ?>/images/home.png" />
                    </span>
                    <span class="text">Home</span>
                </a>
            </div>
            <div class="col-sm-2 col-xs-6 bar-cell bar-cell-half">
                <?php if (Yii::$app->user->isGuest) { ?>
                    <a id="profile" href="<?= Url::toRoute(["site/login"]) ?>">
                        <span class="image-wrapper">
                            <img src="<?=Url::base() ?>/images/user.png" />
                        </span>
                        <span class="text">Log In</span>
                    </a>
                <?php } else { ?>
                    <a id="profile" href="<?= Url::toRoute(["user/edit"]) ?>">
                        <span class="image-wrapper">
                            <?php if ($user->image) { ?>
                                <img src="<?= Url::base() . "/pics" . $user->image ?>" />
                            <?php } else { ?>
                                <img src="<?=Url::base() ?>/images/user.png" />
                            <?php } ?>
                        </span>
                        <span class="text">Profile</span>
                    </a>
                <?php } ?>
            </div>
            <div class="col-sm-4 col-xs-12 bar-cell">
                <span id="time"><?= date("H:i", time()) ?></span>
            </div>
            <div class="col-sm-4 col-xs-12 bar-cell bg-dark-red">
                <a id="sos" href="#">SOS</a>
            </div>
        </div>
    </div>
</div>