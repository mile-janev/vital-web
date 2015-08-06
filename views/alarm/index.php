<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AlarmSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Alarms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alarm-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Alarm', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'time',
            'created_at',
            'updated_at',
            [
                'label' => Yii::t( 'app', 'Patient' ),
                'format' => 'raw',
                'attribute' => 'patient_id',
                'value' => function ( $data ) {
                    return "<a href='".yii\helpers\Url::toRoute(['user/view', 'id'=>$data->patient_id])."'>"."(".$data->patient_id.") ".$data->patient->name."</a>";
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
