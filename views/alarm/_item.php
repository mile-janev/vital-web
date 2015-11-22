<?php $title = 'Edit: ' . $model->title . " - " . date("m/d/Y H:i", strtotime($model->time)); ?>
<div class="row row-measure">
    <div class="col-lg-6 col-lg-6 col-sm-6 col-xs-12 data">
        <?= date("m/d/Y H:i", strtotime($model->time)) . " - "
            . $model->title ?>
    </div>
<?php if ($model->from_id == Yii::$app->user->id) { ?>
    <div class="col-lg-1 col-md-1 col-sm-2 col-xs-4">
        <a href="#" class="btn btn-success btn-edit modalLog" rel="<?= \yii\helpers\Url::toRoute(["alarm/edit-own", "id" => $model->id]) ?>" title="<?= $title ?>">Edit</a>
    </div>
<?php } ?>
</div>