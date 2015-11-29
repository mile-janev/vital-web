<?php
    use yii\helpers\Html;
    use yii\widgets\DetailView;
    use yii\helpers\Url;
    use app\models\User;
    use yii\web\View;
    use yii\helpers\Json;
    use yii\bootstrap\Modal;
    
    $mews = User::mews($user->id);

    $this->title = $user->name;
    $this->params['breadcrumbs'][] = ['label' => 'My patients', 'url' => ['site/index']];
    $this->params['breadcrumbs'][] = $this->title . " (" . $mews . ")";
?>

<?php 
    Modal::begin([
        'header'=>'<h4>Add Medication</h4>',
        'id'=>'modal',
        'size'=>'modal_lg',
    ]);
    echo"<div id='modalContent'></div>";
    Modal::end();
?>

<div class="measurements-view-text container">
    
    <div class="row row-measure">
        <div class="col-xs-12">
            <br />
            <?= Html::button('Add Medication', ['value'=>Url::to(['medication/add', 'id' => $user->id]), 'class' => 'btn btn-success', 'id'=>'modalButton']) ?>
        </div>
    </div>

    <div class="sub-title">Medications for <?= $user->name ?>:</div>

    <div class="measurements-wrapper">
        <?php
        echo yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => '_item_doctor',
            'summary' => '',
        ]);
        ?>
    </div>

</div>

<?= $this->render("../layouts/_popup-info") ?>