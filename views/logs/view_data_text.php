<?php
    use app\models\User;
    use app\components\Functions;
    use yii\bootstrap\Modal;

    $signName = Functions::formatSign($sign);

    $this->title = $signName . ' measurements';
    if (User::patientDoctorNurse($user->id, Yii::$app->user->id)) {
        $this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['user/patients']];
        $this->params['breadcrumbs'][] = ['label' => $user->name, 'url' => ['user/patient', 'id' => Yii::$app->user->id]];
    }
    $this->params['breadcrumbs'][] = $this->title;
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

    <a class="go-back" href="<?= \yii\helpers\Url::toRoute(["logs/overview"]) ?>">&#8592; Go back</a>
    
    <div class="sub-title">Your last <?= $signModel->name ?> measurements:</div>

    <div class="measurements-wrapper">
        <?php
        echo yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => '_data_text',
            'viewParams'=>['signModel' => $signModel],
            'summary' => '',
        ]);
        ?>
    </div>

</div>
