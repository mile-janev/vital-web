<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Connection */

$this->title = $model->user->name . " <-> " . $this->title = $model->patient->name;
$this->params['breadcrumbs'][] = ['label' => 'Connections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="connection-view container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'user_id' => $model->user_id, 'patient_id' => $model->patient_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'user_id' => $model->user_id, 'patient_id' => $model->patient_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => Yii::t( 'app', 'User' ),
                'format'  => 'raw', 
                'value' => $model->user->name,
            ],
            [
                'label' => Yii::t( 'app', 'Patient' ),
                'format'  => 'raw', 
                'value' => $model->patient->name,
            ],
        ],
    ]) ?>

</div>
