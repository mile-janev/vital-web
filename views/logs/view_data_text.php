<?php
use yii\helpers\Html;
use app\models\User;
use yii\helpers\Url;
use app\components\Functions;

$signName = Functions::formatSign($sign);

$this->title = $signName . ' measurements';
if (User::patientDoctorNurse($user->id, Yii::$app->user->id)) {
    $this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['user/patients']];
    $this->params['breadcrumbs'][] = ['label' => $user->name, 'url' => ['user/patient', 'id' => Yii::$app->user->id]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="measurements-view-text container">

    <div class="sub-title">Your last 8 measurements:</div>

    <div class="measurements-wrapper">
        <?php foreach ($logs as $log) : ?>
            <div class="row row-measure">
                <div class="col-lg-4 col-lg-4 col-sm-6 col-xs-12 data">
                    <?= date("m/d/Y H:i", strtotime($log->created_at)) . " - " . $log->value . " " . $signModel->measure ?>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-2 col-xs-4">
                    <a class="btn btn-success btn-edit" href="<?= Url::toRoute(["logs/edit", "id" => $log->id]) ?>">Edit</a>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-2 col-xs-4">
                    <?= Html::a('Delete', Url::toRoute(["logs/delete-own", "id" => $log->id]), [
                        'class' => 'btn btn-success',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this record?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>
