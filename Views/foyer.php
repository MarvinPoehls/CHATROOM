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
                    <input type="text" class="form-control my-3" maxlength="20" id="username" placeholder="Benutzername" value="<?php if($controller->getRequestParameter('username')) echo $controller->getRequestParameter('username'); ?>">
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
                        <input type="text" class="form-control my-3" maxlength="32" id="roomInput" placeholder="Name des Chatrooms">
                    </div>
                    <div class="col-12 col-lg-6 d-grid">
                        <button type="button" onclick="checkLoad()" class="btn btn-primary my-3">Chatroom beitreten</button>
                    </div>
                    <div class="col-12 col-lg-6 d-grid text-end">
                        <button type="button" onclick="checkCreate()" class="btn btn-primary my-3">Neuen Chatroom anlegen</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 d-sm-none d-md-block"></div>
    <div class="col-3 d-sm-none d-md-block"></div>
    <div class="col-12 col-md-6 mb-5">
        <div class="card text-center my-3">
            <h2 class="border-bottom m-2 pb-2">Zufällige Chatrooms<button class="btn float-end" onClick="window.location.reload();"><i class="bi bi-arrow-clockwise"></i></button></h2>
            <?php foreach (Chatroom::getRandomRooms(4) as $room) { ?>
                <button class="p-2 m-2 btn btn-outline-light text-secondary" onclick="checkUsername('<?= $room ?>')"><h3><?= $room ?></h3></button>
            <?php } ?>
        </div>
    </div>
    <div class="col-3 d-sm-none d-md-block"></div>
</div>
<div id="modal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p id="errorText">Error</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= $projectPath ?>js/checkInput.js"></script>