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
        $sql = "SELECT name FROM chatroom WHERE name = '" . $room . "'";
        $result = DatabaseConnection::executeMysqlQuery($sql);
        if ($row = mysqli_fetch_row($result)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public static function getIdByName($name)
    {
        $sql = "SELECT id FROM chatroom WHERE name = ".$name;
        $result = DatabaseConnection::executeMysqlQuery($sql);
        $result = mysqli_fetch_row($result);
        return $result[0];
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


}