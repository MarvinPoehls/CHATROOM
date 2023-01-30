<div class="row h-100 bg-white">
    <div class="col-2 bg-light border-end">
        <div class="d-flex flex-column flex-shrink-0 p-3">
            <p class="fw-bold fs-4 align-items-center ms-4 pb-4 border-bottom">Aktive Teilnehmer</p>
        </div>
        <div id="activUser" class="overflow-auto">
            <?php foreach ($controller->getMembers() as $member) { ?>
                <div class="row bg-white p-2 m-2 rounded">
                    <div class="col-3">
                        <img src="https://www.senertec.de/wp-content/uploads/2020/04/blank-profile-picture-973460_1280-600x600.png" class="d-inline-block rounded-circle" height="40" width="40">
                    </div>
                    <div class="col">
                        <p><?= $member ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="col">
        <div class="row bg-light border-bottom p-1">
            <div class="col">
                <h2>Chatroom: <span id="room"><?= $controller->getName(); ?></span></h2>
            </div>
        </div>
        <div class="row bg-white p-4 overflow-auto" style="height: 80vh">
            <div id="messages">
                <?php foreach ($controller->getData() as $data) {?>
                    <?php if ($data["message"] != "") { ?>
                        <?php if ($data["username"] == $controller->getUsername()) {?>
                            <div class="col-12 my-2 p-2">
                                <div class="row">
                                    <div class="col text-end">
                                        <div class="bg-light rounded-3 d-inline-block p-3 pb-0">
                                            <p><?= $data["message"] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-1 text-end">
                                        <img src="https://www.senertec.de/wp-content/uploads/2020/04/blank-profile-picture-973460_1280-600x600.png" width="60" height="60" class="d-inline-block rounded-circle">
                                    </div>
                                </div>
                            </div>
                        <?php } else {?>
                            <div class="col-12 my-2 p-2">
                                <div class="row">
                                    <div class="col-1">
                                        <img src="https://www.senertec.de/wp-content/uploads/2020/04/blank-profile-picture-973460_1280-600x600.png" width="60" height="60" class="d-inline-block rounded-circle">
                                    </div>
                                    <div class="col">
                                        <div class="bg-primary rounded-3 text-white d-inline-block p-3 pb-0">
                                            <p class="fw-bold mb-1"><?= $data["username"] ?></p>
                                            <p><?= $data["message"] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        <div class="row bg-white p-4">
            <div class="col-11">
                <textarea type="text" class="form-control" id="message" maxlength="100" rows="1" cols="10" style="resize: none"></textarea>
                <input type="hidden" id="file" value="<?= $controller->getName() . '.csv'; ?>">
                <input type="hidden" id="username" value="<?= $controller->getUsername(); ?>">
                <input type="hidden" id="messageCount" value="<?= $controller->getMessageCount(); ?>">
            </div>
            <div class="col-1">
                <button type="button" class="btn btn-primary rounded-circle" onclick="addMessage()"><i class="bi bi-send-fill"></i></button>
            </div>
        </div>
    </div>
</div>
<script src="<?= $projectPath ?>js/addMessage.js"></script>
<script src="<?= $projectPath ?>js/onlineStatus.js"></script>