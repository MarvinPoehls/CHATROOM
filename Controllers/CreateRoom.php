<?php

class CreateRoom extends BaseController
{
    function render()
    {
        $roomName = $this->getRequestParameter("room");
        $username = $this->getRequestParameter("username");
        $headers = ["message","name"];
        $file = fopen("chatlogs/".$roomName . ".csv", "w");
        fputcsv($file, $headers);
        $room = new Chatroom();
        $room->setName($roomName);
        $room->setChatlog($roomName . ".csv");
        $room->save();
        $this->redirect("index.php?controller=Room&room=".$roomName."&username=".$username);
        exit();
    }
}