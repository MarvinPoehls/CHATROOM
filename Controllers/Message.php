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
        $values = [];
        $values[] .= $this->getRequestParameter("text");
        $values[] .= $this->getRequestParameter("user");
        $values[] .= $this->getRequestParameter("image");
        $filename = $this->getRequestParameter("file");

        $file = fopen("chatlogs/".$filename, "a");

        fputcsv($file, $values);

        fclose($file);
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