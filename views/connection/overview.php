<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;

$this->title = 'Contacts | Healthcare Record System';
?>

<?php 
    Modal::begin([
        'header'=>'<h4>Add Contact</h4>',
        'id'=>'modal',
        'size'=>'modal_lg',
    ]);
    echo"<div id='modalContent'></div>";
    Modal::end();
?>

<div class="site-contacts container">
    
    <div class="measurements-wrapper">
        <div class="row row-measure">
            <?= Html::button('Add Contact', ['value'=>Url::to(['connection/add']), 'class' => 'btn btn-success', 'id'=>'modalButton']) ?>
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