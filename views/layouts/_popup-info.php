<div id="modalInfo" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 id="infoModalTitle" class="modal-title"><?= isset($title) ? $title : "Title" ?></h4>
            </div>

            <div class="modal-body">

                <div id="infoModalContent" class="popupContent"><?= isset($content) ? $content : "Content" ?></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal"><?= Yii::t("app", "Close") ?></button>
            </div>

        </div>
    </div>
</div>