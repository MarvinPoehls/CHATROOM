<?php

class UserController extends BaseController
{
    public function render()
    {

    }

    public function add()
    {
        $room = $this->getRequestParameter("room");
        $chatroom = new Chatroom();
        $roomId = $chatroom->getIdByName($room);

        $username = $this->getRequestParameter("username");
        $user = new User();
        $userId = $user->getIdByName($username);

        User2Chatroom::addConnection($userId, $roomId);
        exit();
    }

    public function delete()
    {
        $room = $this->getRequestParameter("room");
        $chatroom = new Chatroom();
        $roomId = $chatroom->getIdByName($room);

        $username = $this->getRequestParameter("username");
        $user = new User();
        $userId = $user->getIdByName($username);

        User2Chatroom::deleteConnection($userId, $roomId);
        exit();
    }

    public function getActive()
    {
        $room = $this->getRequestParameter('room');

        $chatroom = new Chatroom();
        $chatroom->load($chatroom->getIdByName($room));
        $members = $chatroom->getMembers();
        echo json_encode($members);
        exit();
    }

    public function isUserOnline()
    {
        $room = $this->getRequestParameter('room');
        $username = $this->getRequestParameter("username");

        $user = new User();
        $userId = $user->getIdByName($username);

        $chatroom = new Chatroom();
        $roomId = $chatroom->getIdByName($room);

        echo json_encode(User2Chatroom::isDuplicate($userId, $roomId));
    }
}