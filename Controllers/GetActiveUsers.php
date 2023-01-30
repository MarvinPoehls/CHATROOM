<?php

class GetActiveUsers extends BaseController
{
    public function render()
    {
        $room = $this->getRequestParameter('room');

        $chatroom = new Chatroom();
        $chatroom->load($chatroom->getIdByName($room));
        $members = $chatroom->getMembers();
        echo json_encode($members);
    }
}