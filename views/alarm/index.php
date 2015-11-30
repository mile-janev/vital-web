<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

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
        <?= Html::button('Add Alarm', ['value'=>Url::to(['alarm/create']), 'class' => 'btn btn-success','id'=>'modalButton']) ?>
    </p>

    <?php 
        Modal::begin([
            'header'=>'<h4>Add Alarm</h4>',
            'id'=>'modal',
            'size'=>'modal_lg',
        ]);
        echo"<div id='modalContent'></div>";
        Modal::end();
    ?>
    
    
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
                'label' => Yii::t( 'app', 'From' ),
                'format' => 'raw',
                'attribute' => 'from_id',
                'value' => function ( $data ) {
                    return "<a href='".yii\helpers\Url::toRoute(['user/view', 'id'=>$data->from_id])."'>"."(".$data->from_id.") ".$data->from->name."</a>";
                },
            ],
            [
                'label' => Yii::t( 'app', 'For' ),
                'format' => 'raw',
                'attribute' => 'for_id',
                'value' => function ( $data ) {
                    return "<a href='".yii\helpers\Url::toRoute(['user/view', 'id'=>$data->for_id])."'>"."(".$data->for_id.") ".$data->for->name."</a>";
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
