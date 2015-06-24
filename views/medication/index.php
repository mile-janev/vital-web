<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MedicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Medications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medication-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Medication', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'rx_number',
            'name',
            'strength',
            'strength_measure',
            // 'schedule:ntext',
            // 'note:ntext',
            // 'patient_id',
            // 'prescribed_by_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
