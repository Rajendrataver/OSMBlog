<?php
include './classes/DBConnection.php';
class Category extends DataBase
{
    function getCategory()
    {
        $sql = $this->connection->prepare("SELECT * from categories");
        $sql->execute();
        return $sql;
    }
}
?>