<div id="modalInfo" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 id="infoModalTitle" class="modal-title">Reminder</h4>
            </div>

            <div class="modal-body">

                <div id="infoModalContent" class="popupContent"><?= $alarm->title ?></div>

            </div>

            <div class="modal-footer">
                <div id="url" class="hidden"><?= \yii\helpers\Url::toRoute(["alarm/done"]) ?></div>
                <button id="reminder-later" type="button" class="btn btn-success" data-dismiss="modal">Later</button>
                <button id="reminder-done" type="button" class="btn btn-success" data-dismiss="modal" rel="<?= $alarm->id ?>">Done</button>
            </div>

        </div>
    </div>
</div>