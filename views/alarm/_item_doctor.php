<?php $title = 'Edit: ' . $model->title . " - " . date("m/d/Y H:i", strtotime($model->time)); ?>
<div class="row row-measure">
    <div class="col-lg-6 col-lg-6 col-sm-6 col-xs-12 data">
        <?= date("m/d/Y H:i", strtotime($model->time)) . " - "
            . $model->title ?>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <a href="#" class="btn btn-success btn-edit modalLog" rel="<?= \yii\helpers\Url::toRoute(["alarm/edit-doctor", "id" => $model->id]) ?>" title="<?= $title ?>">Edit</a>
        <?= \yii\helpers\Html::a('Delete', \yii\helpers\Url::toRoute(["alarm/delete-doctor", "id" => $model->id]), [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => 'Are you sure you want to delete this record?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
</div>