<?php

class Room extends BaseController
{
    protected $title = "Room";
    protected $view = "room";
    protected $name = "roomname";
    protected $chatroom;
    protected $member = [];

    public function render()
    {
        $this->name = $this->getRequestParameter("room");
        $this->chatroom = new Chatroom(Chatroom::getIdByName($this->name));
        parent::render();
    }

    public function getName()
    {
        return $this->name;
    }

    public function getData(): array
    {
        $data = [];
        $file = fopen("chatlogs/".$this->chatroom->getChatlog(), "r");
        fgetcsv($file);
        while($row = fgetcsv($file)) {
            $data[] = array("message" => $row[0], "name" => $row[1]);
        }
        fclose($file);
        return $data;
    }
}