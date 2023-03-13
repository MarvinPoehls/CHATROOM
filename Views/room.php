<div class="row flex-nowrap h-100 overflow-hidden bg-room">
    <div id="sidebar" class="overflow-x-hidden overflow-y-auto h-96 w-15 bg-blue z-top flex-nowrap p-0">
        <div class="p-md-2">
            <div class="row p-0">
                <div class="col text-light overflow-hidden pt-1">
                    <h4 class="w-auto responsive-header text-center">Aktive Teilnehmer</h4>
                </div>
            </div>
        </div>
        <div id="activeUser"></div>
    </div>
    <div class="col">
        <div class="row bg-darker-blue p-1 shadow">
            <div class="col">
                <div class="row">
                    <div class="col-lg-auto col-md-6 col-auto text-light">
                        <h2>Chatroom: <span id="room"><?= $controller->getName(); ?></span></h2>
                    </div>
                    <div class="col"></div>
                    <div class="col-auto d-flex align-items-center">
                        <div class="row float-end">
                            <div class="col-auto d-flex align-items-center" data-toggle="tooltip" data-placement="bottom" title="Push Nachrichten">
                                <button type="button" class="btn border bg-light p-1" data-bs-toggle="modal" data-bs-target="#pnModal">
                                    <i id="bell" class="bi bi-bell-fill"></i>
                                </button>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                <select id="notificationOption" class="form-select-sm btn border bg-light" style="width: 170px">
                                    <option>Benachrichtigungstöne</option>
                                    <option value="activ">Aktiviert</option>
                                    <option value="inactiv">Deaktiviert</option>
                                    <option value="background">Nur wenn Fenster im Hintergrund</option>
                                </select>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                <a href="index.php?username=<?= $controller->getUsername() ?>" class="btn btn-danger"><span class="d-none d-md-inline">Raum Verlassen</span> <i class="bi bi-door-open-fill"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-1 px-sm-4 overflow-auto position-relative d-flex align-items-start mh-69 mh-sm-80" id="messages">
            <?php foreach ($controller->getData() as $data) {?>
                <?php if (($data["message"] != "" || $data["image"] != "") && $controller->isMessageSendAfterJoin($data["time"])) { ?>
                    <?php if ($data["username"] == $controller->getUsername()) {?>
                        <div class="col-1 col-md-3"></div>
                        <div class="col-11 col-md-9 my-2 p-2">
                            <div class="row flex-nowrap">
                                <div class="col text-end">
                                    <div class="bg-light rounded-3 d-inline-block p-2">
                                        <?php if ($data["image"] != "") { ?>
                                            <a href="<?= $data["image"] ?>" data-toggle="lightbox">
                                                <img src="<?= $data["image"] ?>" width="200" class="img-fluid rounded">
                                            </a>
                                        <?php } ?>
                                        <p class="text-start text-break mb-0 decode"><?= $data["message"] ?></p>
                                        <p class="m-0 float-start text-muted"><?= $data["time"] ?></p>
                                    </div>
                                </div>
                                <div class="col-auto text-end">
                                    <img src="https://www.linkpicture.com/q/ProfilPictureDark.png" width="60" height="60" class="rounded-circle img-fluid">
                                </div>
                            </div>
                        </div>
                    <?php } else {?>
                        <div class="col-11 col-md-9 my-2 p-2">
                            <div class="row flex-nowrap">
                                <div class="col-auto">
                                    <img src="https://www.linkpicture.com/q/ProfilPictureDark.png" width="60" height="60" class="rounded-circle img-fluid">
                                </div>
                                <div class="col">
                                    <div class="bg-primary rounded-3 text-white d-inline-block p-2">
                                        <p class="fw-bold mb-1"><?= $data["username"] ?></p>
                                        <?php if ($data["image"] != "") { ?>
                                            <a href="<?= $data["image"] ?>" data-toggle="lightbox" data-gallery="<?= $controller->getName() ?>-gallery">
                                                <img src="<?= $data["image"] ?>" width="200" class="img-fluid rounded">
                                            </a>
                                        <?php } ?>
                                        <p class="text-break mb-0 decode"><?= $data["message"] ?></p>
                                        <p class="m-0 float-end"><?= $data["time"] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-1 col-md-3"></div>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="row p-4 position-fixed bottom-0 w-85">
            <div class="col" id="textCol">
                <textarea type="text" class="form-control resize-none" id="message" rows="1" cols="10"></textarea>
                <input type="hidden" id="encryption" value="<?= $controller->getEncryption(); ?>">
                <input type="hidden" id="username" value="<?= $controller->getUsername(); ?>">
            </div>
            <div class="col-auto float-end" id="buttonCol">
                <div class="row">
                    <div class="col d-none" id="imageInputCol">
                        <input type="text" class="form-control d-inline-block bg-darker-blue text-white border border-dark" id="fileName" disabled>
                    </div>
                    <div class="col-auto p-0">
                        <label id="inputLabel" for="imageInput" class="btn p-1 pe-2" role="button">
                            <i class="bi bi-paperclip text-white" id="inputIcon"></i>
                        </label>
                        <button type="button" class="btn btn-primary shadow-lg rounded-circle" onclick="sendMessage()"><i class="bi bi-send-fill"></i></button>
                        <input type="file" class="d-none" id="imageInput" onchange="imageInput()" accept="image/png, image/jpeg image/gif image/svg">
                        <input class="d-none" id="deleteInput" onclick="clearInputs(false)">
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
                <p id="modalText">Möchtest du Push Benachrichtigungen bekommen, wenn die Website im Hintergrund geöffnet ist?</p>
            </div>
            <div id="modalFooter" class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="requestNotificationPermission()">Ja</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Nein</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= $projectPath ?>js/decodeMessages.js"></script>
<script src="<?= $projectPath ?>js/message.js"></script>
<script src="<?= $projectPath ?>js/room.js"></script>
<script src="<?= $projectPath ?>js/onlineStatus.js"></script>