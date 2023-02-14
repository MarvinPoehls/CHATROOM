<div class="row flex-nowrap bg-white h-100 overflow-hidden">
    <div class="col-auto px-0">
        <div id="sidebar" class="collapse border-end vh-100 bg-light">
            <div class="p-2">
                <h4>Aktive Teilnehmer</h4>
            </div>
            <div id="activeUser"></div>
        </div>
    </div>
    <div class="col">
        <div class="row bg-light border-bottom p-1">
            <div class="col">
                <div class="row">
                    <div class="col-auto d-flex align-items-center">
                        <button data-bs-target="#sidebar" data-bs-toggle="collapse" class="border rounded-3 p-1 text-dark bg-white">
                            <i class="bi bi-list"></i>
                        </button>
                    </div>
                    <div class="col-lg-auto col-md-6 col-auto">
                        <h2>Chatroom: <span id="room"><?= $controller->getName(); ?></span></h2>
                    </div>
                    <div class="col"></div>
                    <div class="col-auto d-flex align-items-center">
                        <div class="row float-end">
                            <div class="col-auto d-flex align-items-center" data-toggle="tooltip" data-placement="bottom" title="Push Nachrichten">
                                <button type="button" class="btn p-1" data-bs-toggle="modal" data-bs-target="#pnModal">
                                    <i class="bi bi-bell-fill"></i>
                                </button>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                <select id="notificationOption" class="form-select-sm btn border bg-white">
                                    <option>Benachrichtigungen</option>
                                    <option value="activ">Aktiviert</option>
                                    <option value="inactiv">Deaktiviert</option>
                                    <option value="background">Nur wenn Fenster im Hintergrund</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row bg-white p-4 overflow-auto position-relative" id="messages" style="height: 80%">
            <?php foreach ($controller->getData() as $data) {?>
                <?php if ($data["message"] != "" || $data["image"] != "") { ?>
                    <?php if ($data["username"] == $controller->getUsername()) {?>
                        <div class="col-3"></div>
                        <div class="col-9 my-2 p-2">
                            <div class="row flex-nowrap">
                                <div class="col text-end">
                                    <div class="bg-light rounded-3 d-inline-block p-3 pb-0">
                                        <?php if ($data["image"] != "") { ?>
                                            <img src="<?= $data["image"] ?>" width="200" class="mb-2 img-fluid rounded">
                                        <?php } ?>
                                        <p class="text-start text-break decode"><?= $data["message"] ?></p>
                                    </div>
                                </div>
                                <div class="col-auto text-end">
                                    <img src="https://i.postimg.cc/1XffnWPL/Profil-Picture.png" width="60" height="60" class="rounded-circle img-fluid">
                                </div>
                            </div>
                        </div>
                    <?php } else {?>
                        <div class="col-9 my-2 p-2">
                            <div class="row flex-nowrap">
                                <div class="col-auto">
                                    <img src="https://i.postimg.cc/1XffnWPL/Profil-Picture.png" width="60" height="60" class="rounded-circle img-fluid">
                                </div>
                                <div class="col">
                                    <div class="bg-primary rounded-3 text-white d-inline-block p-3 pb-0">
                                        <p class="fw-bold mb-1"><?= $data["username"] ?></p>
                                        <?php if ($data["image"] != "") { ?>
                                            <img src="<?= $data["image"] ?>" width="200" class="mb-2 img-fluid rounded">
                                        <?php } ?>
                                        <p class="text-break decode"><?= $data["message"] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3"></div>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="row bg-white p-4">
            <div class="col">
                <textarea type="text" class="form-control" id="message" rows="1" cols="10" style="resize: none;"></textarea>
                <input type="hidden" id="file" value="<?= $controller->getName() . '.csv'; ?>">
                <input type="hidden" id="encryption" value="<?= $controller->getEncryption() ?>">
                <input type="hidden" id="username" value="<?= $controller->getUsername(); ?>">
                <input type="hidden" id="messageCount" value="<?= $controller->getMessageCount(); ?>">
            </div>
            <div class="col-auto" id="buttonCol">
                <div class="row">
                    <div class="col d-none" id="imageInputCol">
                        <input type="text" class="form-control" id="fileName" disabled>
                    </div>
                    <div class="col-auto p-0">
                        <label id="inputLabel" for="imageInput" class="btn" role="button">
                            <i class="bi bi-paperclip" id="inputIcon"></i>
                        </label>
                        <button type="button" class="btn btn-primary rounded-circle ms-3" onclick="addMessage()"><i class="bi bi-send-fill"></i></button>
                        <input type="file" class="d-none" id="imageInput" onchange="imageInput()" accept="image/png, image/jpeg image/gif image/svg">
                        <input class="d-none" id="deleteInput" onclick="clearImageInput()">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="pnModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p>Möchtest du Push Benachrichtigungen bekommen, wenn die Website im Hintergrund geöffnet ist?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ja</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Nein</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= $projectPath ?>js/decodeMessages.js"></script>
<script src="<?= $projectPath ?>js/message.js"></script>
<script src="<?= $projectPath ?>js/onlineStatus.js"></script>