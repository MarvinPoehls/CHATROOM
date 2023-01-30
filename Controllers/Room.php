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

        $this->addUser2Chatroom();

        parent::render();
    }

    public function getMessageCount(): int
    {
        $file = fopen("chatlogs/".$this->name.".csv", "r");
        fgetcsv($file);
        $i = 0;
        while ($row = fgetcsv($file)) {
            $i++;
        }
        return $i;
    }

    public function deleteUser()
    {
        $room = $this->getRequestParameter("room");
        $chatroom = new Chatroom();
        $roomId = $chatroom->getIdByName($room);

        $username = $this->getRequestParameter("username");
        $user = new User();
        $userId = $user->getIdByName($username);

        User2Chatroom::deleteConnection($userId, $roomId);
    }

    public function getMembers()
    {
        return $this->chatroom->getMembers();
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
    }

    protected function addUser2Chatroom()
    {
        if ($this->chatroom->isUserNew($this->user->getId())) {
            $u2a = new User2Chatroom();
            $u2a->setUserId($this->user->getId());
            $u2a->setChatroomId($this->chatroom->getId());
            $u2a->save();
        }
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}