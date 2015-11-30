<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Medication */

$this->title = 'Add Medication';
$this->params['breadcrumbs'][] = ['label' => 'Medications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medication-create container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
