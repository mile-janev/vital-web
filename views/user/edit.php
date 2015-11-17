<?php
    use yii\helpers\Html;

    $this->title = 'Edit: ' . ' ' . $model->name;
    $this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view-own']];
    $this->params['breadcrumbs'][] = 'Edit';
?>
<div class="user-update container-fluid">

    <div class="row">
        <div class="col-xs-12 text-center">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
        'user' => $user,
        'hide_role' => TRUE,
    ]) ?>

</div>
