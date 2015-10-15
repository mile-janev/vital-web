<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;

$this->title = 'Reminders | Healthcare Record System';
?>

<?php 
    Modal::begin([
        'header'=>'<h4>Reminder</h4>',
        'id'=>'modal',
        'size'=>'modal_lg',
    ]);
    echo"<div id='modalContent'></div>";
    Modal::end();
?>

<div class="site-contacts container">
    
    <div class="measurements-wrapper">
        <div class="row row-measure">
            <?= Html::button('Add Reminder', ['value'=>Url::to(['alarm/add-own']), 'class' => 'btn btn-success', 'id'=>'modalButton']) ?>
        </div>
        
        <?php foreach ($models as $model) : ?>
            <?php $title = 'Edit: ' . $model->title . " - " . date("m/d/Y H:i", strtotime($model->time)); ?>
            <div class="row row-measure">
                <div class="col-lg-6 col-lg-6 col-sm-6 col-xs-12 data">
                    <?= date("m/d/Y H:i", strtotime($model->time)) . " - "
                        . $model->title ?>
                </div>
            <?php if ($model->from_id == Yii::$app->user->id) { ?>
                <div class="col-lg-1 col-md-1 col-sm-2 col-xs-4">
                    <a href="#" class="btn btn-success btn-edit modalLog" rel="<?= Url::toRoute(["alarm/edit-own", "id" => $model->id]) ?>" title="<?= $title ?>">Edit</a>
                </div>
            <?php } ?>
            </div>
        <?php endforeach; ?>
    </div>
    
</div>