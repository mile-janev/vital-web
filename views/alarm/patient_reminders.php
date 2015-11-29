<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;

$this->title = $user->name;

$mews = app\models\User::mews($user->id);
$this->params['breadcrumbs'][] = ['label' => 'My patients', 'url' => ['site/index']];
$this->params['breadcrumbs'][] = $this->title . " (" . $mews . ")";
?>

<?php 
    Modal::begin([
        'header'=>'<h4>Reminder</h4>',
        'id'=>'modal',
        'size'=>'modal_lg',
    ]);
    echo"<div id='modalContent'></div>";
    Modal::end();
?>

<div class="site-contacts container">
    
    <div class="measurements-wrapper">
        <div class="row row-measure">
            <?= Html::button('Add Reminder', ['value'=>Url::to(['alarm/add-doctor', 'for_id' => $user->id]), 'class' => 'btn btn-success', 'id'=>'modalButton']) ?>
        </div>
        
        <?php
        echo yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => '_item_doctor',
            'summary' => '',
        ]);
        ?>
    </div>
    
</div>