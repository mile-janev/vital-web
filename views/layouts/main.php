<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use app\components\Functions;
use app\models\Role;

/* @var $this \yii\web\View */
/* @var $content string */

$user = false;
if (Yii::$app->user->id) {
    $user = app\models\User::find()->where(['id' => Yii::$app->user->id])->one();
}

AppAsset::register($this);
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
        <?php elseif(Functions::isRole(Role::DOCTOR)) : ?>
            <?= $this->render('_doctor-header', [
                'user' => $user
            ]) ?>
        <?php else : ?>
        <?= $this->render('_header', [
                'user' => $user
            ]) ?>
        <?php endif; ?>
        

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="col-xs-12 col-sm-6">
                <div class="row">&copy; Copyright <?= date('Y') ?> by SiMYan. All rights reserved.</div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="row">
                    <ul class="footer-links">
                        <li><a href="<?= Url::toRoute('site/about') ?>">About</a></li>
                        <li><a href="<?= Url::toRoute('site/contact') ?>">Contact Us</a></li>
                        <li><a href="<?= Url::toRoute('site/privacy') ?>">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
