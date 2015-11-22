<?php
    use yii\helpers\Html;
    use app\models\User;
    use yii\helpers\Url;
    use app\components\Functions;

    $this->title = 'Medical Records | Healthcare Record System';
?>
<div class="measurements-view-text container">
    
    <div class="sub-title">Your last medications:</div>

    <div class="measurements-wrapper">
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

<?= $this->render("../layouts/_popup-info") ?>