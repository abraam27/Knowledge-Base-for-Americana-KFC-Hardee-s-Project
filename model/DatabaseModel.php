<?php
require_once '../../config.php';
class DatabaseModel
{
    public function setFieldsValue()
    {
        $string = "";
        foreach ($this->tableFields as $fieldName){
            $string .= $fieldName . " = '" . $this->$fieldName . "', " ;
        }
        return rtrim($string, ", ");
    }
    public function add()
    {
        global $dbh;
        $sql = $dbh->prepare("INSERT INTO " . static::$tableName . " SET " . $this->setFieldsValue());
        if($sql->execute()){
            // get last insert id
            return $dbh->lastInsertId();
        }else{
            return false;
        }
    }
    public function update($id)
    {
        global $dbh;
        $sql = $dbh->prepare("UPDATE " . static::$tableName . " SET " . $this->setFieldsValue() . " WHERE ". static::$tableName ."ID = '$id'");
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }
    public static function delete($id)
    {
        global $dbh;
        $sql = $dbh->prepare("DELETE FROM " . static::$tableName ." WHERE ".static::$tableName."id='$id'");
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }
    public static function readAll()
    {
        global $dbh;
        $sql = $dbh->prepare("SELECT *  FROM " . static::$tableName);
        if($sql->execute()){
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }
    public static function readByID($id)
    {
        global $dbh;
        $sql = $dbh->prepare("SELECT *  FROM " . static::$tableName . " WHERE ".static::$tableName."ID='$id'");
        if($sql->execute()){
            return $sql->fetch(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }
}