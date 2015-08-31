<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LogsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logs-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Create Log', ['value'=>Url::to(['logs/create']), 'class' => 'btn btn-success','id'=>'modalButton']) ?>
    </p>
    
    <?php 
        Modal::begin([
            'header'=>'<h4>Log Sign</h4>',
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
            'sign',
            'value',
            'description:ntext',
            'created_at',
            [
                'label' => Yii::t( 'app', 'User' ),
                'format' => 'raw',
                'attribute' => 'user_id',
                'value' => function ( $data ) {
                    return "<a href='".yii\helpers\Url::toRoute(['user/view', 'id'=>$data->user_id])."'>"."(".$data->user_id.") ".$data->user->name."</a>";
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
