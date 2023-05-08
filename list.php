<h1>this is connection check</h1>
<?php
include './head.php';
include './classes/userClass.php';
$user = new User();


$userList = $user->getUsers(null);

while ($row = $userList->fetch()) {
    echo "<pre>";
    print_r($row);
    echo "</pre>";
}

// echo 'password :';

// var_dump(password_verify('12345678', '$2y$10$V/em2P9EqaTLsYT1NCXhdO0TEC/KtkaR4T3Gw0BeIUKC7OZ6ifaGW'))

?>