<div class="row">
    <div class="col-2 bg-light">
        <div class="d-flex flex-column flex-shrink-0 p-3 vh-100">
            <p class="fw-bold fs-4 d-flex align-items-center ms-4 mb-3 mb-md-0">Teilnehmer</p>
            <hr>
            <div class="row">
                <div class="col-3">
                    <img src="https://picsum.photos/200" width="30" height="30" class="d-inline-block align-top rounded-circle" alt="">
                </div>
                <div class="col-9 fw-bold d-flex align-items-center" >
                    <p class="m-0">Marvin Pöhls</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="row bg-primary text-white p-2">
            <div class="col">
                <h1><?= $controller->getName(); ?></h1>
            </div>
        </div>
        <div id="messages" class="row bg-white p-4 h-75 overflow-auto">
            <?php foreach ($controller->getData() as $data) {?>
                <?php if ($data["message"] != "") { ?>
                    <div class="col-12 my-2 p-2">
                        <div class="row">
                            <div class="col-1">
                                <img src="https://picsum.photos/200" width="60" height="60" class="d-inline-block rounded-circle">
                            </div>
                            <div class="col">
                                <div class="bg-primary rounded-3 text-white d-inline-block p-3 pb-0">
                                    <p class="fw-bold mb-1"><?= $data["name"] ?></p>
                                    <p><?= $data["message"] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="row bg-white p-4">
            <div class="col-11">
                <input type="text" class="form-control" id="message">
                <input type="hidden" id="file" value="<?= $controller->getName() . '.csv' ?>">
            </div>
            <div class="col-1">
                <button type="button" class="btn btn-primary" onclick="addMessage()"><i class="bi bi-send-fill"></i></button>
            </div>
        </div>
    </div>
</div>
<script src="<?= $projectPath ?>js/addMessage.js"></script>