<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;

$this->title = 'Contacts | Healthcare Record System';
?>

<?php 
    Modal::begin([
        'header'=>'<h4>Add Contact</h4>',
        'id'=>'modal',
        'size'=>'modal_lg',
    ]);
    echo"<div id='modalContent'></div>";
    Modal::end();
?>

<div class="site-contacts container">
    
    <div class="measurements-wrapper">
        <div class="row row-measure">
            <?= Html::button('Add Contact', ['value'=>Url::to(['connection/add']), 'class' => 'btn btn-success','id'=>'modalButton']) ?>
        </div>
        
        <?php foreach ($user->patientConnection as $conUser) : ?>
            <?php $usr = $conUser->user; ?>
            <div class="row row-measure">
                <div class="col-lg-6 col-lg-6 col-sm-6 col-xs-12 data">
                    <?= $usr->name ?>,
                    <a href="mailto: <?= $usr->email ?>"><?= $usr->email ?></a>,
                    <span><?= $usr->role->description ?></span>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
                    <?= Html::a('Remove', Url::toRoute(["connection/remove-own", "user_id" => $usr->id]), [
                        'class' => 'btn btn-success',
                        'data' => [
                            'confirm' => 'Are you sure you want to remove this contact?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
</div>