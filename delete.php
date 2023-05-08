<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location:login.php');
}
include './classes/blogClass.php';
$id = $_GET['id'];
$aid = $_SESSION['id'];
$blog = new Blog();
$res = $blog->delete($id, $aid);
if ($res) {
    header('Location:dashboard.php');
} else {
    header('Location:logout.php');
}
?>