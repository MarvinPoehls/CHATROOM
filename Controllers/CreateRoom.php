<?php

class CreateRoom extends BaseController
{
    function render()
    {
        $roomName = $this->getRequestParameter("room");
        fopen("chatlogs/".$roomName . ".csv", "w");
        $room = new Chatroom();
        $room->setName($roomName);
        $room->setChatlog($roomName . ".csv");
        $room->save();
        $this->redirect("index.php?controller=Room&room=".$roomName);
        exit();
    }
}