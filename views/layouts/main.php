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
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
