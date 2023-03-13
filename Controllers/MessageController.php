<?php

class Message extends BaseController
{
    public function countMessages()
    {
        $room = $this->getRequestParameter("room");

        $messageCount = 0;
        $file = fopen("chatlogs/".$room.".csv", "r");
        fgetcsv($file);
        while ($row = fgetcsv($file)) {
            $messageCount++;
        }
        echo $messageCount;
        exit();
    }

    public function addMessage()
    {
        $text = $this->getRequestParameter("text");
        $image = $this->getRequestParameter("image");
        $time = $this->getRequestParameter("time");

        $user = new User();
        $userId = $user->getIdByName($this->getRequestParameter("user"));

        $room = new Chatroom();
        $roomId = $room->getIdByName($this->getRequestParameter("room"));

        $sql = "INSERT INTO message (text, image, user_id, chatroom_id) VALUES ('$text', '$image', '$userId', '$roomId')";
        DatabaseConnection::executeMysqlQuery($sql);

        exit();
    }

    public function getRow()
    {
        $file = $this->getRequestParameter("file");
        $row = $this->getRequestParameter("row");

        $file = fopen("chatlogs/".$file, 'r');
        fgetcsv($file);

        $i = 1;
        while ($line = fgetcsv($file)) {
            if($i == $row){
                print json_encode($line);
                exit();
            }
            $i++;
        }
        exit();
    }
}