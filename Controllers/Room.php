<?php

class Room extends BaseController
{
    protected $title = "Room";
    protected $view = "room";
    protected $name = "roomname";
    protected $chatroom;
    protected $username = "";
    protected $user;

    public function render()
    {
        $this->name = $this->getRequestParameter("room");
        $this->chatroom = new Chatroom();
        $this->chatroom->load($this->chatroom->getIdByName($this->name));

        $this->username = $this->getRequestParameter("username");

        $this->checkUser();

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
            $data[] = array("message" => $row[0], "username" => $row[1]);
        }
        fclose($file);
        return $data;
    }

    protected function checkUser()
    {
        $this->user = new User();
        if ($this->user->isNew($this->username)) {
            $this->user->setName($this->username);
            $this->user->save();
        } else {
            $this->user->load($this->user->getIdByName($this->username));
        }

        $user2chatroom = new User2Chatroom();
        if ($user2chatroom->isNew($this->user->getId(), $this->chatroom->getId())) {
            $user2chatroom->setUserId($this->user->getId());
            $user2chatroom->setChatroomId($this->chatroom->getId());
            $user2chatroom->save();
        }
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getMembers()
    {
        return $this->chatroom->getMembers();
    }
}