<?php

class CreateRoom extends BaseController
{
    function render()
    {
        $roomName = $this->getRequestParameter("room");
        $username = $this->getRequestParameter("username");
        $room = new Chatroom();
        $room->setName($roomName);
        $room->setEncryption(bin2hex(random_bytes(32)));
        echo $room->getEncryption();
        $room->save();
        $this->redirect("index.php?controller=Room&room=".$roomName."&username=".$username);
        exit();
    }
}