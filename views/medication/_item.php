<div class="row row-measure">
    <div class="col-lg-6 col-lg-6 col-sm-6 col-xs-12 data">
        <?= date("m/d/Y H:i", strtotime($model->created_at)) . " - " 
            . "Rx: <b>" . $model->rx_number . "</b>, " . $model->name 
            . " " . $model->strength . " " . $model->strength_measure  ?>
    </div>
    <div class="col-lg-1 col-md-1 col-sm-2 col-xs-4">
        <button rel="#medic_<?= $model->id ?>" class="btn btn-success btn-view view-medication" data-target="#modalInfo" data-toggle="modal" type="button">View</button>
        <div id="medic_<?= $model->id ?>" class="hide" rel="RX: <?= $model->rx_number ?>">
            <b>Medication:</b><br /> <?= $model->name . " " . $model->strength . " " . $model->strength_measure ?><br />
            <b>Schedule:</b> <?= $model->schedule ?><br />
            <b>Note:</b> <?= $model->note ?> <br /><br />
            <?= date("m/d/Y H:i", strtotime($model->created_at)) ?>
        </div>
    </div>
</div>