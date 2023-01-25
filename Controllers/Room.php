<?php

class Room extends BaseController
{
    protected $title = "Room";
    protected $view = "room";
    protected $name = "roomname";
    protected $chatroom;
    protected $member = [];
    protected $messages = [];

    public function render()
    {
        $this->name = $this->getRequestParameter("room");
        $this->chatroom = new Chatroom(Chatroom::getIdByName($this->name));
        parent::render();
    }

    public function load()
    {
        //$member = get Group Member
        //$messages = get messages in order
    }

    public function getName()
    {
        return $this->name;
    }

    public function getMessages()
    {
        $file = fopen("chatlogs/".$this->chatroom->getChatlog(), "r+");
        while(!feof($file)) {
            $this->messages[] .= fgets($file);
        }
        fclose($file);
        return $this->messages;
    }
}