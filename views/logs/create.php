<?php

use yii\helpers\Html;

$this->title = 'Log Measurement';
$this->params['breadcrumbs'][] = ['label' => 'Measurements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logs-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
