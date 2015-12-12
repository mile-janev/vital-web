<?php
    use yii\helpers\Html;
    use yii\grid\GridView;
    use yii\helpers\Url;

    $this->title = 'Users';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', Url::toRoute(['user/create']), ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'email:email',
            [
                'label' => Yii::t( 'app', 'Role' ),
                'filter' => \app\models\Role::getRoleOptions(),
                'attribute' => 'role_id',
                'value' => function ($model, $key, $index, $column){
                    return $model->role->description;
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-eye-open"></span>',
                                Url::toRoute(['/user/view', 'id' => $model->id])
                            );
                        },
                        'update' => function ($url, $model, $key) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-pencil"></span>',
                                Url::toRoute(['/user/update', 'id' => $model->id])
                            );
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-trash"></span>',
                                Url::toRoute(['/user/delete', 'id' => $model->id]),
                                [
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this item?',
                                        'method' => 'post',
                                    ],
                                ]
                            );
                        },
                    ]
            ],
        ],
    ]); ?>

</div>
