<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Connection */

$this->title = 'Update Connection: ' . ' ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Connections', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'user_id' => $model->user_id, 'patient_id' => $model->patient_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="connection-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
