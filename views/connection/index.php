<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ConnectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Connections';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="connection-index container">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Connection', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => Yii::t( 'app', 'User' ),
                'format' => 'raw',
                'attribute' => 'user_id',
                'value' => function ( $data ) {
                    return "<a href='".yii\helpers\Url::toRoute(['user/view', 'id'=>$data->user_id])."'>"."(".$data->user_id.") ".$data->user->name."</a>";
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
