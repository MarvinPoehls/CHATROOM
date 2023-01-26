<?php

class User extends BaseModel
{
    protected $table = "user";
    protected $columns = ["name"];
    protected $id;
    protected $name;

    public function isNew($user): bool
    {
        $sql = "SELECT id FROM " .$this->table." WHERE name = '" . $user . "'";
        $result = DatabaseConnection::executeMysqlQuery($sql);
        $result = mysqli_fetch_row($result);
        if (isset($result[0])) {
            return false;
        }
        return true;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }


}