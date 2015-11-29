<div class="row row-measure">
    <div class="col-lg-6 col-lg-6 col-sm-6 col-xs-12 data">
        <?= date("m/d/Y H:i", strtotime($model->created_at)) . " - " 
            . "Rx: <b>" . $model->rx_number . "</b>, " . $model->name 
            . " " . $model->strength . " " . $model->strength_measure  ?>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <button rel="#medic_<?= $model->id ?>" class="btn btn-success btn-view view-medication" data-target="#modalInfo" data-toggle="modal" type="button">View</button>
        <a href="#" class="btn btn-success btn-edit modalLog" rel="<?= \yii\helpers\Url::toRoute(["medication/edit", "id" => $model->id]) ?>">Edit</a>
        <?= \yii\helpers\Html::a('Delete', \yii\helpers\Url::toRoute(["medication/delete-doctor", "id" => $model->id]), [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => 'Are you sure you want to delete this record?',
                'method' => 'post',
            ],
        ]) ?>
        <div id="medic_<?= $model->id ?>" class="hide" rel="RX: <?= $model->rx_number ?>">
            <b>Medication:</b><br /> <?= $model->name . " " . $model->strength . " " . $model->strength_measure ?><br />
            <b>Schedule:</b> <?= $model->schedule ?><br />
            <b>Note:</b> <?= $model->note ?> <br /><br />
            <?= date("m/d/Y H:i", strtotime($model->created_at)) ?>
        </div>
    </div>
</div>