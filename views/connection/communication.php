<?php
    use yii\helpers\Url;
    use app\models\User;

    $this->title = 'Communication';
    $this->params['breadcrumbs'][] = $this->title;
?>

<?php if (count($user->patientConnection) > 0) { ?>
    <div class="site-communication container-fluid">

        <div class="row">

                <?php foreach ($user->patientConnection as $key => $conUser) : ?>
                    <?php $usr = $conUser->user; ?>
                    <div class="col-xs-6 col-sm-3 block-sign block-sign-splitted bbb <?= (($key+1)%4!==0) ? "brb" : "" ?>">
                        <a href="<?= Url::toRoute(["connection/call", "id" => $usr->id]) ?>">
                            <span class="image-wrapper">
                                <img src="<?= ($usr->image) ? Url::base()."/pics".$usr->image : Url::base()."/images/user.png" ?>" />
                            </span>
                            <span class="text">
                                <img width="22" src="<?= Url::base() ?>/images/phone_green.png" />
                                <?= $usr->name ?>
                            </span>
                        </a>
                    </div>
                <?php endforeach; ?>

        </div>

    </div>
<?php } else { ?>
    <div class="site-communication container">
        <div class="row">
            <div class="col-xs-12">
                <h4>No connections</h4>
                <p>
                    <a href="<?= Url::toRoute(['connection/overview']) ?>" class="btn btn-success">Connect</a>
                </p>
            </div>
        </div>
    </div>
<?php } ?>