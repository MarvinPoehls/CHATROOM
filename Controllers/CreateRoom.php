<?php

class CreateRoom extends BaseController
{
    function render()
    {
        $roomName = $this->getRequestParameter("room");
        $username = $this->getRequestParameter("username");
        $privacy = $this->getRequestParameter("privacy");

        if($privacy == "true") {
            $privacy = 1;
        } else {
            $privacy = 0;
        }

        $room = new Chatroom();
        $room->setName($roomName);
        $room->setEncryption(bin2hex(random_bytes(32)));
        $room->setPrivate($privacy);
        echo $room->getEncryption();
        $room->save();
        $this->redirect("index.php?controller=Room&room=".$roomName."&username=".$username);
        exit();
    }
}