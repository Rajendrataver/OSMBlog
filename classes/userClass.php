<?php
require './classes/DBConnection.php';
class User extends DataBase
{
    function getUsers($condition)
    {
        if ($condition) {
            $sql = $this->connection->prepare("SELECT * FROM users where $condition");
        } else {
            $sql = $this->connection->prepare("SELECT * FROM users");
        }
        $sql->execute();
        return $sql;
    }
    function is_already($condition)
    {
        $sql = $this->connection->prepare("SELECT * FROM users WHERE $condition");
        $sql->execute();
        if ($sql->fetch()) {
            return true;
        } else {
            return false;
        }
    }
    function register($name, $email, $username, $password, $gender, $profile_image)
    {

        $name = $this->checkInput($name);
        $email = $this->checkInput($email);
        $username = $this->checkInput($username);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $gender = $this->checkInput($gender);
        $token = bin2hex(random_bytes(16));
        $status = 0;
        $is_verified = 0;

        try {
            $sql = $this->connection->prepare("INSERT INTO users (name,email,username,password,gender,profile_image,status,is_verified,token) values(:name,:email,:username,:password,:gender,:profile_image,:status,:is_verified,:token)");
            $sql->bindParam(':name', $name);
            $sql->bindParam(':email', $email);
            $sql->bindParam(':username', $username);
            $sql->bindParam(':password', $password);
            $sql->bindParam(':gender', $gender);
            $sql->bindParam(':profile_image', $profile_image);
            $sql->bindParam(':status', $status);
            $sql->bindParam(':is_verified', $is_verified);
            $sql->bindParam(':token', $token);
            $res = $sql->execute();
            if ($res) {
                $res = sendmail($email, $token);
                return $res;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

    }
    function update($id, $name, $email, $username, $password, $gender, $profile_image)
    {
        $name = $this->checkInput($name);
        $email = $this->checkInput($email);
        $username = $this->checkInput($username);
        $gender = $this->checkInput($gender);

        try {
            if ($password) {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $sql = $this->connection->prepare("UPDATE users SET password='$password', name='$name',email='$email',username='$username',gender='$gender',profile_image='$profile_image' where id=$id");
            } else {
                $sql = $this->connection->prepare("UPDATE users SET name='$name',email='$email',username='$username',gender='$gender',profile_image='$profile_image' where id=$id");
            }
            $res = $sql->execute();
            return $res;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    function verify($token)
    {
        $sql = $this->connection->prepare("SELECT * FROM users where token='$token' and status=0 and is_verified=0");
        $sql->execute();
        if ($row = $sql->fetch()) {
            print_r($row);
            $status = $is_verified = 1;
            try {
                $sql = $this->connection->prepare("UPDATE users SET status=$status,is_verified=$is_verified where token='$token'");
                $sql->execute();
                var_dump($sql->fetch());
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        } else {
            return false;
        }
    }
    function verifyPassword($email, $password)
    {

        $sql = $this->connection->prepare("SELECT * FROM users where (email='$email')");
        $sql->execute();

        if ($row = $sql->fetch()) {
            $res = password_verify($password, $row['password']);
            if ($res) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    function login($email, $password)
    {
        $sql = $this->connection->prepare("SELECT * FROM users where (email='$email' and status=1)or(username='$email'and status=1)");
        $sql->execute();
        if ($row = $sql->fetch()) {
            $res = password_verify($password, $row['password']);
            if ($res) {
                return $row;
            } else {
                false;
            }
        } else {
            false;
        }
    }

}
?>