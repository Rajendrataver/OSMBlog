
<?php
include './classes/mailer.php';
class DataBase
{
    public $connection;
    function __construct()
    {
        $db_name = "mysql:host=localhost;dbname=Blog;";
        $this->connection = new PDO($db_name, "root", "root");

    }
    function checkInput($input)
    {
        return $input;
    }
}
?>