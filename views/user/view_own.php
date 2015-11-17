<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view container-fluid">

    <div class="row">
        <div class="col-xs-12 text-center">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'email:email',
            'role.description',
            'created_at',
            'updated_at',
            [
                'label' => Yii::t( 'app', 'Image' ),
                'format'  => 'raw', 
                'value' => ($model->image) ? "<img src='/pics".$model->image."' height='50' />" : NULL,
            ],
        ],
    ]) ?>

</div>
