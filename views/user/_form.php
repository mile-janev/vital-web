<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use kartik\file\FileInput;
    use yii\helpers\Url;
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <div class="col-xs-12 col-sm-8">
        <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= (isset($hide_role) && $hide_role) ? "" : $form->field($model, 'role_id')->dropDownList(app\models\Role::getRoleOptions()) ?>

        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'password_confirm')->passwordInput(['maxlength' => true]) ?>
    </div>
    
    <div class="col-xs-12 col-sm-4">
        <?php
            $initialPreview = FALSE;
            $initialPreviewConfig = FALSE;

            if ($model->image) {
                $initialPreview = Html::img(Url::base() . '/pics' . $model->image, ['class' => 'file-preview-image']);
                $initialPreviewConfig['key'] = $model->id;
                $initialPreviewConfig['caption'] = $model->name;
            }

            echo $form->field($model, 'image')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'previewFileType' => 'image',
                    'showCaption' => FALSE,
                    'showRemove' => FALSE,
                    'showUpload' => FALSE,
                    'removeClass' => 'btn btn-primary',
                    'uploadClass' => 'btn btn-primary',
                    'browseClass' => 'btn btn-primary',
                    'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                    'browseLabel' => 'Choose avatar',
                    'initialCaption' => $model->name,
                    'overwriteInitial' => TRUE,
                    'initialPreview' => $initialPreview,
                    'initialPreviewConfig' => $initialPreviewConfig,
                ],
            ]); 
        ?>
    </div>
    
    <div class="col-xs-12">
        <div class="form-group">
            <?= Html::submitButton($user->isNewRecord ? 'Create' : 'Update', ['class' => $user->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    
    <div class="col-xs-12">
        <?php if (Yii::$app->session->hasFlash('profile_updated')){ ?>
           <div class="form-group flash-successfull">
               <?= Yii::$app->session->getFlash('profile_updated'); ?>
           </div>
       <?php } ?>
    </div>

</div>
