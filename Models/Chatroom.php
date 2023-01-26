<?php

class Chatroom extends BaseModel
{
    protected $table = "chatroom";
    protected $columns = ["id", "name", "chatlog"];
    protected $id = "";
    protected $name = "";
    protected $chatlog = "";

    public function __construct($id = false)
    {
        if ($id) {
            $this->load($id);
        }
    }

    public function isDuplicate()
    {
        $controller = new BaseController();
        $room = $controller->getRequestParameter("room");
        $sql = "SELECT name FROM ".$this->table." WHERE name = '" . $room . "'";
        $result = DatabaseConnection::executeMysqlQuery($sql);
        if ($row = mysqli_fetch_row($result)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public function setId(string $id)
    {
        $this->id = $id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getChatlog(): string
    {
        return $this->chatlog;
    }

    public function setChatlog(string $chatlog)
    {
        $this->chatlog = $chatlog;
    }

    public function getMembers(): array
    {
        $sql = "SELECT user.name FROM `user`
                LEFT JOIN user2chatroom ON user.id = user2chatroom.user_id
                LEFT JOIN chatroom ON chatroom_id = chatroom.id
                WHERE chatroom.id = '".$this->id."';";
        $result = DatabaseConnection::executeMysqlQuery($sql);
        $members = array();
        while ($row = mysqli_fetch_row($result)) {
            $members[] .= $row[0];
        }
        return $members;
    }
}