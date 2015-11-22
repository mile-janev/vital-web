<div class="row row-measure">
    <div class="col-lg-6 col-lg-6 col-sm-6 col-xs-12 data">
        <?= $model->name ?>,
        <a href="mailto: <?= $model->email ?>"><?= $model->email ?></a>,
        <span><?= $model->role->description ?></span>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
        <?= yii\helpers\Html::a('Remove', \yii\helpers\Url::toRoute(["connection/remove-own", "user_id" => $model->id]), [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => 'Are you sure you want to remove this contact?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
</div>