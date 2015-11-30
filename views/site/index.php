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
        <?= $this->render('_index-doctor', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]) ?>
    <?php elseif(Functions::isRole(Role::FAMILY)) : ?>
        <?= $this->render('_index-family') ?>
    <?php elseif(Functions::isRole(Role::PATIENT) || Functions::isRole(Role::VISITOR)) : ?>
        <?= $this->render('_index-patient') ?>
    <?php else : ?>
        <?= $this->render('_index-landing', ['model' => $model]) ?>
    <?php endif; ?>
    
</div>