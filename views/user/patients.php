<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'email:email',
            [
                'label' => Yii::t( 'app', 'Image' ),
                'format' => 'raw',
                'attribute' => 'image',
                'value' => function ( $data ) {
                    if ($data['image']) {
                        $avatar = "/pics/".$data['image'];
                    } else {
                        $avatar = "/images/user.png";
                    }
                    return "<img src='".$avatar."' width='50' />";
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-eye-open"></span>',
                                \yii\helpers\Url::toRoute(['/user/patient', 'id' => $model->id])
                            );
                        },
                    ]
            ],
        ],
    ]); ?>

</div>
