<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Logs */

$this->title = 'Log Measurement';
$this->params['breadcrumbs'][] = ['label' => 'Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'user_id' => $user_id,
        'sign' => $sign,
        'signModel' => $signModel,
    ]) ?>

</div>
