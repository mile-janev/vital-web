<?php
    use yii\helpers\Url;
?>

<div id="bar-top" class="bar bar-patient">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 bar-cell bar-cell-half border-bottom-small">
                <a id="home" href="<?= Url::base(TRUE) ?>">
                    <span class="image-wrapper">
                        <img src="<?= Url::base() ?>/images/home.png" />
                    </span>
                    <span class="text">Home</span>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 bar-cell bar-cell-half border-bottom-small">
                <a id="profile" href="<?= Url::toRoute(["user/edit"]) ?>">
                    <span class="image-wrapper">
                        <?php if ($user->image) { ?>
                            <img src="<?= Url::base() . "/pics" . $user->image ?>" />
                        <?php } else { ?>
                            <img src="<?= Url::base() ?>/images/user.png" />
                        <?php } ?>
                    </span>
                    <span class="text">Profile</span>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 bar-cell bar-cell-half border-bottom-small logout-patient-wrapper">
                <a id="logout-patient" href="<?= Url::toRoute(['site/logout']) ?>">Log out</a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 bar-cell bar-cell-half">
                <span id="time"><?= date("H:i", time()) ?></span>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 bar-cell bg-dark-red">
                <a id="sos" href="<?= Url::toRoute(["user/sos"]) ?>">SOS</a>
            </div>
        </div>
    </div>
</div>