<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view container">

    <div class="row">
        <div class="col-xs-12 text-center">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

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
