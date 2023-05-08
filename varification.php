<?php
include './classes/userClass.php';
$token = $_GET['token'];
$user = new User();
$res = $user->verify($token);
if ($res) {
    header('Location: login.php');
} else {
    echo "<h1>Link has expired</h1>";
}
?>