<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <div class="card text-center mt-4">
            <h1 class="card-title p-4">Willkommen bei Chatroom!</h1>
        </div>
    </div>
    <div class="col-3"></div>
    <div class="col-3"></div>
    <div class="col-6">
        <div class="card mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <input type="text" class="form-control my-3" name="room" id="username" placeholder="Benutzername">
                    </div>
                    <div class="col-12">
                        <input type="text" class="form-control my-3" name="room" id="roomInput" placeholder="Name des Chatrooms">
                    </div>
                    <div class="col-6">
                        <button type="button" onclick="checkLoad()" class="btn btn-primary my-3">Chatroom beitreten</button>
                    </div>
                    <div class="col-6 text-end">
                        <button type="button" onclick="checkCreate()" class="btn btn-primary my-3">Neuen Chatroom anlegen</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3"></div>
</div>
<div id="modal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p id="errorText">Error</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= $projectPath ?>js/checkInput.js"></script>