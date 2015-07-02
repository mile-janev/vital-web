<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = "Patient: " . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['patients']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This should be special view for patient, mabye single patient page.
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'email:email',
            [
                'label' => Yii::t( 'app', 'Image' ),
                'format'  => 'raw', 
                'value' => ($model->image) ? "<img src='/pics".$model->image."' height='50' />" : NULL,
            ],
        ],
    ]) ?>

</div>
