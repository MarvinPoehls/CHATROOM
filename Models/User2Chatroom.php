<?php

class User2Chatroom extends BaseModel
{
    protected $table = "user2chatroom";
    protected $columns = ["user_id", "chatroom_id"];
    protected $user_id;
    protected $chatroom_id;

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

    public function setChatroomId($chatroom_id)
    {
        $this->chatroom_id = $chatroom_id;
    }

    public function isNew($userId, $chatroomId): bool
    {
        $sql = "SELECT id FROM " .$this->table." WHERE user_id = '" . $userId . "' AND chatroom_id = ".$chatroomId;
        $result = DatabaseConnection::executeMysqlQuery($sql);
        $result = mysqli_fetch_row($result);
        if (isset($result[0])) {
            return false;
        }
        return true;
    }

    public static function deleteConnection($userId, $roomId)
    {
        $sql = "DELETE FROM user2connection WHERE user_id = '".$userId."' AND room_id = '".$roomId."'";
        DatabaseConnection::executeMysqlQuery($sql);
    }
}