<?php

class Room extends BaseController
{
    protected $title = "Room";
    protected $view = "room";
    protected $name = "roomname";
    protected $username = "";
    protected $chatroom;
    protected $user;

    public function render()
    {
        $this->name = $this->getRequestParameter("room");
        $this->chatroom = new Chatroom();
        $this->chatroom->load($this->chatroom->getIdByName($this->name));

        $this->username = $this->getRequestParameter("username");
        $this->checkUser();

        $u2c = new User2Chatroom();
        $u2c->setUserId($this->user->getId());
        $u2c->setChatroomId($this->chatroom->getId());
        $u2c->save();

        parent::render();
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
        $messageModel = new Message();
        $data = $messageModel->getMessages($this->chatroom->getId());
        $messages = [];
        foreach($data as $message) {
            $messages[] = array("message" => $message[0], "username" => $message[1], "image" => $message[2], "time" => $message[3]);
        }
        return $messages;
    }

    public function isMessageSendAfterJoin($messageTime): bool
    {
        $messageTime = strtotime($messageTime);
        $joinTime = User2Chatroom::getJoinTimeByUsername($this->username);
        $joinTime = strtotime($joinTime);
        if ($messageTime > $joinTime) {
            return true;
        }
        return false;
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

    public function simplifyTime($time)
    {
        $time = strtotime($time);
        return date('H:i', $time);
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEncryption(): string
    {
        return $this->chatroom->getEncryption();
    }
}