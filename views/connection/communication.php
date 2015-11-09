<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use app\models\User;

$this->title = 'Communication | Healthcare Record System';
?>

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