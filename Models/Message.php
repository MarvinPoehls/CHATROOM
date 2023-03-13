<?php

class Message extends BaseModel
{
    protected $table = 'message';
    protected $columns = ['text', 'image', 'user_id', 'chatroom_id'];
    protected $id;
    protected $text;
    protected $image;
    protected $user_id;
    protected $chatroom_id;

    public function getMessages($roomId): array
    {
        $sql = "SELECT text, user.name, image, created_at FROM $this->table LEFT JOIN user on user_id = user.id WHERE chatroom_id = $roomId";
        $result = DatabaseConnection::executeMysqlQuery($sql);
        $messages = [];
        while ($row = mysqli_fetch_row($result)) {
            $messages[] = $row;
        }
        return $messages;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text)
    {
        $this->text = $text;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image)
    {
        $this->image = $image;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($userId)
    {
        $this->user_id = $userId;
    }

    public function getChatroomId()
    {
        return $this->chatroom_id;
    }

    public function setChatroomId($chatroomId)
    {
        $this->chatroom_id = $chatroomId;
    }
}