<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MedicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Medications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medication-index container">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add Medication', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'rx_number',
            'name',
            [
                'label' => Yii::t( 'app', 'Dose' ),
                'format' => 'raw',
                'attribute' => 'strength',
                'value' => function ( $data ) {
                    return $data->strength . " " . $data->strength_measure;
                },
            ],
            [
                'label' => Yii::t( 'app', 'Patient' ),
                'format' => 'raw',
                'attribute' => 'patient_id',
                'value' => function ( $data ) {
                    return "<a href='".yii\helpers\Url::toRoute(['user/view', 'id'=>$data->patient_id])."'>"."(".$data->patient_id.") ".$data->patient->name."</a>";
                },
            ],
            [
                'label' => Yii::t( 'app', 'Prescribed By' ),
                'format' => 'raw',
                'attribute' => 'prescribed_by_id',
                'value' => function ( $data ) {
                    return "<a href='".yii\helpers\Url::toRoute(['user/view', 'id'=>$data->prescribed_by_id])."'>"."(".$data->prescribed_by_id.") ".$data->prescribedBy->name."</a>";
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
