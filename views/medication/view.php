<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Medication */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Medications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medication-view container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'rx_number',
            'name',
            'strength',
            'strength_measure',
            'schedule:ntext',
            'note:ntext',
            [
                'label' => Yii::t( 'app', 'Patient' ),
                'format'  => 'raw', 
                'value' => $model->patient->name,
            ],
            [
                'label' => Yii::t( 'app', 'Prescribed By' ),
                'format'  => 'raw', 
                'value' => $model->prescribedBy->name,
            ],
        ],
    ]) ?>

</div>
