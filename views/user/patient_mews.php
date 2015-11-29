<?php
    use app\models\User;
    use app\components\Functions;

    $this->title = $user->name;
    $mews = app\models\User::mews($user->id);
    $this->params['breadcrumbs'][] = ['label' => 'My patients', 'url' => ['site/index']];
    $this->params['breadcrumbs'][] = $this->title . " (" . $mews . ")";
?>

<div class="patient-mews container">

    <div class="patient-mews">
        Comming soon!
    </div>

</div>
