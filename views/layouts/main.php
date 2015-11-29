<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use app\components\Functions;
use app\models\Role;

/* @var $this \yii\web\View */
/* @var $content string */

$user = false;
if (Yii::$app->user->id) {
    $user = app\models\User::find()->where(['id' => Yii::$app->user->id])->one();
    $alarm = \app\models\Alarm::findUserAlarm();
}

app\assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="icon" type="image/png" href="<?php echo Url::base(); ?>/images/favicon.ico" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    
    <div class="wrap">
        
        <?php if (Functions::isRole(Role::ADMINISTRATOR)) : ?>
            <?= $this->render('_admin-header', [
                'user' => $user
            ]) ?>
        <?php elseif(Functions::isRole(Role::DOCTOR) || Functions::isRole(Role::NURSE)) : ?>
            <?= $this->render('_bar-doctor', [
                'user' => $user,
                'alarm' => $alarm
            ]) ?>
        <?php elseif(Functions::isRole(Role::FAMILY)) : ?>
            <?= $this->render('_other-header', [
                'user' => $user
            ]) ?>
        <?php elseif(Functions::isRole(Role::PATIENT) || Functions::isRole(Role::VISITOR)) : ?>
            <?= $this->render('_bar-patient', [
                'user' => $user
            ]) ?>
        <?php else : ?>
            <?= $this->render('_bar', [
                'user' => $user
            ]) ?>
        <?php endif; ?>
            
        <div id="content" class="container-fluid <?= (Functions::isRole(Role::DOCTOR) || Functions::isRole(Role::NURSE)) ? "" : "add-margin" ?>">
            <?= $content ?>
        </div>
        
        <?php if (!Yii::$app->user->isGuest) { ?>
        <footer class="footer">
            <?= $this->render('_footer', [
                'user' => $user,
                'alarm' => $alarm
            ]) ?>
        </footer>
        <?php } ?>
    </div>
    
    <div id="sosNote" class="hidden" rel="<?= Url::toRoute(["alarm/check-sos"]) ?>">
        <?= (Functions::isRole(Role::DOCTOR) || Functions::isRole(Role::NURSE)) ? 1 : 0 ?>
    </div>

<?=$this->render('_popup-call') ?>
    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
