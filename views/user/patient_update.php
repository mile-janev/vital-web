<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = "Patient update: " . $user->name;
$this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['patients']];
$this->params['breadcrumbs'][] = $this->title;
?>
Test