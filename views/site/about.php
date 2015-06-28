<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Vital is completely free and you do not need to pay any fee for using.</p>
    <p>
        Vital is combined system from website and android application.
        All information published on our website will be shared with our android application and vice versa.
    </p>
    <p>
        You can log your informations using our android application, or entering directly on our website.
        Our android application can be connected with different devices for measuring vital data,
        like blood pressure monitor, heart rate monitor, respiratory assist device and other.
        Any value entered or modified on website or android applciation is affecting on both of them,
        only when you will have Internet access.
    </p>
    <p>
        Vital primarly is intended for retirees and retirement homes, but also can be used for any enthusiast
        who wants to log his vital signs.
    </p>
    
    <h2>How to download the Vital android application?</h2>
    <p>You can download the application on <a href="#">this link</a>.</p>
    
    <h2>How to register or login on the android application?</h2>
    <p>
        You can register only on <a href="<?= yii\helpers\Url::toRoute(['site/register']) ?>">website</a> 
        or only on android applciation. You are using the same credentials for both of them.
    </p>

</div>
