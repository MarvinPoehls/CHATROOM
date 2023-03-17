<div class="row overflow-auto bg-foyer">
    <div class="col-3 d-sm-none d-md-block"></div>
    <div class="col-12 col-md-6">
        <div class="card text-center mt-4">
            <h1 class="card-title p-4">Willkommen bei Chatroom!</h1>
        </div>
    </div>
    <div class="col-3 d-sm-none d-md-block"></div>
    <div class="col-3 d-sm-none d-md-block"></div>
    <div class="col-12 col-md-6">
        <div class="card text-center mt-4">
            <div class="row card-body">
                <div class="col-12">
                    <input type="text" class="form-control my-3" id="username" placeholder="Benutzername" maxlength="70" value="<?php if($controller->getRequestParameter('username')) echo $controller->getRequestParameter('username'); ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 d-sm-none d-md-block"></div>
    <div class="col-3 d-sm-none d-md-block"></div>
    <div class="col-12 col-md-6">
        <div class="card mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <input type="text" class="form-control my-3" maxlength="100" id="roomInput" placeholder="Name des Chatrooms">
                    </div>
                    <div class="col-12 col-lg-6 d-grid">
                        <button type="button" onclick="checkLoad()" class="btn btn-primary my-3">Chatroom beitreten</button>
                    </div>
                    <div class="col-12 col-lg-6 d-grid">
                        <div class="row px-2">
                            <button type="button" onclick="checkCreate()" class="col btn btn-primary my-3 rounded-0 rounded-start">Neuen Chatroom anlegen</button>
                            <div class="col-auto px-0">
                                <button type="button" class="btn btn-primary my-3 rounded-0 rounded-end" onclick="toggleOptions()"><i class="bi bi-gear-fill"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 d-none d-md-block"></div>
                    <div class="col-12 col-md-6 "  style="display: none" id="privacyCheck">
                        <label class="text-secondary"><input type="checkbox" id="private" class="form-check-input" checked> Privater Chatroom</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 d-sm-none d-md-block"></div>
    <div class="col-3 d-sm-none d-md-block"></div>
    <div class="col-12 col-md-6 mb-5">
        <div id="randomChats" class="card text-center my-3">
            <h2 id="randomChatsTitle" class="border-bottom m-2 pb-2">Zufällige Chatrooms<button class="btn float-end" onClick="reloadRandomChats();"><i class="bi bi-arrow-clockwise text-secondary"></i></button></h2>
            <?php foreach (Chatroom::getRandomRooms(4) as $room) { ?>
                <button id="<?= $room ?>" class="p-2 m-2 btn btn-outline-light text-secondary" onclick="checkUsername('<?= $room ?>')"><h3><?= $room ?></h3></button>
            <?php } ?>
        </div>
    </div>
    <div class="col-3 d-sm-none d-md-block"></div>
</div>
<div id="modal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-4">
                <p id="errorText" class="m-0">Error</p>
            </div>
            <div class="modal-footer p-1">
                <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= $projectPath ?>js/checkInput.js"></script>
<script src="<?= $projectPath ?>js/foyer.js"></script>