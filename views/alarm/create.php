<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Alarm */

$this->title = 'Create Alarm';
$this->params['breadcrumbs'][] = ['label' => 'Alarms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alarm-create container">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
