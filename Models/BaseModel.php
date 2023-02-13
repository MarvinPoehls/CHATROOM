<?php

class BaseModel
{
    protected $table = "";
    protected $columns = [];

    public function getIdByName($name)
    {
        $sql = "SELECT id FROM " . $this->table . " WHERE name = '".$name . "'";
        $result = DatabaseConnection::executeMysqlQuery($sql);
        $result = mysqli_fetch_row($result);
        if (isset($result[0])){
            return $result[0];
        }
        return false;
    }

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this, $name)) {
            $this->$name($arguments);
        }
    }

    public function load($id)
    {
        $this->id = $id;
        $sql = "SELECT * FROM ".$this->table." WHERE id = " . $id;
        $result = DatabaseConnection::executeMysqlQuery($sql);
        if (mysqli_num_rows($result) == 0) {
            return false;
        }

        $data = mysqli_fetch_assoc($result);
        foreach ($this->columns as $column) {
            $this->$column = $data[$column];
        }
    }

    public function save()
    {
        if ($this->id == false) {
            $this->create();
        } else {
            $this->update();
        }
    }

    protected function delete()
    {
        $sql = "DELETE FROM ".$this->table." WHERE id =" . $this->id;
        DatabaseConnection::executeMysqlQuery($sql);
    }

    protected function update()
    {
        $sql = "UPDATE ".$this->table." SET ";
        foreach ($this->columns as $column) {
            $sql .= $column."='".$this->$column."', ";
        }
        $sql = trim($sql, ", ")." WHERE id=".$this->id;

        DatabaseConnection::executeMysqlQuery($sql);
    }

    protected function create()
    {
        $values = "";
        foreach ($this->columns as $column) {
            $values .= "'".$this->$column."',";
        }
        $values = trim($values, ",");

        $sql = "INSERT INTO ".$this->table." (".implode(", ",$this->columns).") 
                VALUES (".$values.")";
        DatabaseConnection::executeMysqlQuery($sql);
        $this->id = mysqli_insert_id(DatabaseConnection::getConnection());
    }

    public static function encryptOneWay($password)
    {
        return md5($password . Configuration::getConfigParameter("salt"));
    }
}