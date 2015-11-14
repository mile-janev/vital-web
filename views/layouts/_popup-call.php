<div id="modalCall" class="modal fade " role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 id="infoModalTitle" class="modal-title">New Call</h4>
            </div>

            <div class="modal-body">

                <div id="infoModalContent" class="popupContent"><?= isset($caller) ? $caller : "" ?></div>

            </div>

            <div class="modal-footer">
                <a id="callDismiss" class="btn btn-success" href="#"><?= Yii::t("app", "Dismiss") ?></a>
                <a id="callAnswer" class="btn btn-success" href="<?= yii\helpers\Url::toRoute(['connection/call', "id" => Yii::$app->user->id]) ?>"><?= Yii::t("app", "Answer") ?></a>
            </div>

        </div>
    </div>
</div>
<div id="controller-view" class="hidden"><?= Yii::$app->controller->id . "/" . Yii::$app->controller->action->id ?></div>
<div id="userLogged" class="hidden"><?= (!Yii::$app->user->isGuest) ? 1 : 0 ?></div>