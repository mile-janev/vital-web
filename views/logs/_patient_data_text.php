<?php $title = 'Edit: ' . $model->value . " " . $signModel->measure . " - " . date("m/d/Y H:i", strtotime($model->created_at)); ?>
<div class="row row-measure">
    <div class="col-lg-4 col-lg-4 col-sm-6 col-xs-12 data">
        <?= date("m/d/Y H:i", strtotime($model->created_at)) . " - " . $model->value . " " . $signModel->measure ?>
    </div>

<?php if(!app\components\Functions::isRole(app\models\Role::FAMILY)) : ?>
    <div class="col-lg-1 col-md-1 col-sm-2 col-xs-4">
        <a href="#" class="btn btn-success btn-edit modalLog" rel="<?= \yii\helpers\Url::toRoute(["logs/edit-doctor", "id" => $model->id]) ?>" title="<?= $title ?>">Edit</a>
    </div>
    <div class="col-lg-1 col-md-1 col-sm-2 col-xs-4">
        <?= \yii\helpers\Html::a('Delete', \yii\helpers\Url::toRoute(["logs/delete-doctor", "id" => $model->id]), [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => 'Are you sure you want to delete this record?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
<?php endif; ?>
    
</div>