<?php
    use yii\helpers\Html;
    use yii\grid\GridView;

    $this->title = 'Users';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
