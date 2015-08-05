<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Logs */

$this->title = 'Update Measurement: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="logs-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'user_id' => $user_id,
        'sign' => $sign,
        'signModel' => $signModel,
    ]) ?>

</div>
