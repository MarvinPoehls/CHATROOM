<?php


class User2Chatroom extends BaseModel
{
    protected $table = "user2chatroom";
    protected $columns = ["user_id", "chatroom_id"];
    protected $user_id;
    protected $chatroom_id;
    protected $join_time;

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
        $sql = "DELETE FROM user2chatroom WHERE user_id = '".$userId."' AND chatroom_id = '".$roomId."'";
        DatabaseConnection::executeMysqlQuery($sql);
    }

    public static function addConnection($userId, $roomId)
    {
        if (!self::isDuplicate($userId, $roomId)) {
            $sql = "INSERT INTO user2chatroom (user_id, chatroom_id) VALUES ('".$userId."','".$roomId."')";
            DatabaseConnection::executeMysqlQuery($sql);
        }
    }

    public static function isDuplicate($userId, $roomId): bool
    {
        $sql = "SELECT * FROM user2chatroom WHERE user_id = ". $userId . " AND chatroom_id = ". $roomId;
        $result = DatabaseConnection::executeMysqlQuery($sql);
        if (mysqli_fetch_row($result)) {
            return true;
        }
        return false;
    }

    public static function getJoinTimeByUsername($username)
    {
        $sql = "SELECT join_time FROM `user2chatroom` LEFT JOIN user on user.id = user2chatroom.user_id WHERE user.name = ".$username;
        $result = DatabaseConnection::executeMysqlQuery($sql);
        $row = mysqli_fetch_row($result);
        return $row[0];
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

    public function setChatroomId($chatroom_id)
    {
        $this->chatroom_id = $chatroom_id;
    }

    public function getJoinTime()
    {
        return $this->join_time;
    }
}