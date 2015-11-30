<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Call */

$this->title = 'Create Call';
$this->params['breadcrumbs'][] = ['label' => 'Calls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="call-create container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
