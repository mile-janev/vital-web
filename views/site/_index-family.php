<?php
    use yii\helpers\Html;
    use yii\grid\GridView;
    use yii\helpers\Url;

    $this->title = 'My Family';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index container">

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
                'label' => Yii::t( 'app', 'MEWS' ),
                'format' => 'raw',
                'attribute' => 'mews',
                'value' => function ( $data ) {
                    return app\models\User::mews($data['id']);
                },
            ],
            [
                'label' => Yii::t( 'app', 'Image' ),
                'format' => 'raw',
                'attribute' => 'image',
                'value' => function ( $data ) {
                    if ($data['image']) {
                        $avatar = Url::base(TRUE) . "/pics/".$data['image'];
                    } else {
                        $avatar = Url::base(TRUE) . "/images/user.png";
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
                                Url::toRoute(['/user/patient-dashboard', 'id' => $model->id])
                            );
                        },
                    ]
            ],
        ],
    ]); ?>

</div>
