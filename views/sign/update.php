<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sign */

$this->title = 'Update Sign: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Signs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sign-update container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
