<?php
use yii\helpers\Url;
use app\components\Functions;
use app\models\Role;

$this->title = 'HRS | Healthcare Record System';
?>

<div class="site-index container-fluid">
    
    <?php if (Functions::isRole(Role::ADMINISTRATOR)) : ?>
        <?= $this->render('_index-admin') ?>
    <?php elseif(Functions::isRole(Role::DOCTOR) || Functions::isRole(Role::NURSE)) : ?>
        <?= $this->render('_index-doctor') ?>
    <?php elseif(Functions::isRole(Role::VISITOR) || Functions::isRole(Role::FAMILY)) : ?>
        <?= $this->render('_index-default') ?>
    <?php elseif(Functions::isRole(Role::PATIENT)) : ?>
        <?= $this->render('_index-patient') ?>
    <?php else : ?>
        <?= $this->render('_index-default') ?>
    <?php endif; ?>
    
</div>