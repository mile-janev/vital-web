<?php
use yii\helpers\Html;
use app\models\User;
use app\components\Functions;

$this->title = 'Update ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Measurements', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="logs-update container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
