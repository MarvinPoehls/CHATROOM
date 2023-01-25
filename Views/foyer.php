<div class="card text-center m-2 mt-4">
    <h1 class="card-title p-4">Willkommen bei Chatroom!</h1>
</div>
<div class="row">
    <div class="col-6">
        <form action="index.php" method="get">
            <input type="hidden" name="controller" value="Room">
            <input type="hidden" name="action" value="create">
            <div class="card mt-3 ms-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <button type="button" onclick="checkCreate()" class="btn btn-primary my-3">Neuen Chatroom anlegen</button>
                        </div>
                        <div class="col">
                            <input type="text" required class="form-control my-3" name="room" id="createInput" placeholder="Name des Chatrooms">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-6">
        <form action="index.php" method="get">
            <input type="hidden" name="controller" value="Room">
            <input type="hidden" name="action" value="load">
            <div class="card mt-3 me-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <button type="button" onclick="checkLoad()" class="btn btn-primary my-3">Chatroom beitreten</button>
                        </div>
                        <div class="col">
                            <input type="text" required class="form-control my-3" name="room" id="loadInput" placeholder="Name des Chatrooms">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
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