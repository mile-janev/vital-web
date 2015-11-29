<?php
    use app\models\User;
    use app\components\Functions;
    use yii\bootstrap\Modal;

    $this->title = $user->name;
    $mews = app\models\User::mews($user->id);
    $this->params['breadcrumbs'][] = ['label' => 'My patients', 'url' => ['site/index']];
    $this->params['breadcrumbs'][] = $this->title . " (" . $mews . ")";
?>

<?php 
    Modal::begin([
        'header'=>'<h4 class="modal-title">Log</h4>',
        'id'=>'modal',
        'size'=>'modal_lg',
    ]);
    echo"<div id='modalContent'></div>";
    Modal::end();
?>

<div class="measurements-view-text container">
    
    <div class="sub-title">Last <?= $signModel->name ?> measurements:</div>

    <div class="measurements-wrapper">
        <?php
        echo yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => '_patient_data_text',
            'viewParams'=>['signModel' => $signModel],
            'summary' => '',
        ]);
        ?>
    </div>

</div>
