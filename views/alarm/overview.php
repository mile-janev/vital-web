<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;

$this->title = 'Reminders';
$this->params['breadcrumbs'][] = $this->title;
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
            <?= Html::button('Add Reminder', ['value'=>Url::to(['alarm/add-own']), 'class' => 'btn btn-success', 'id'=>'modalButton']) ?>
        </div>
        
        <?php
        echo yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => '_item',
            'summary' => '',
        ]);
        ?>
    </div>
    
</div>