<?php
    use yii\helpers\Html;
    use yii\widgets\DetailView;
    use yii\helpers\Url;
    use app\models\User;

    $this->title = $model->name;
    $this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['patients']];
    $this->params['breadcrumbs'][] = $this->title;
?>

<?php
    if ($model->image) {
        $avatar = Url::base(TRUE) . "/pics/".$model->image;
    } else {
        $avatar = Url::base(TRUE) . "/images/user.png";
    }
?>

<div class="patient-view">
patient info
    
</div>
