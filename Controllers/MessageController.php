<?php

class MessageController extends BaseController
{
    public function addMessage()
    {
        $text = $this->getRequestParameter("text");
        $image = $this->getRequestParameter("image");

        $user = new User();
        $userId = $user->getIdByName($this->getRequestParameter("user"));

        $room = new Chatroom();
        $roomId = $room->getIdByName($this->getRequestParameter("room"));

        $message = new Message();
        $message->setText($text);
        $message->setImage($image);
        $message->setUserId($userId);
        $message->setChatroomId($roomId);
        $message->save();

        exit();
    }
}