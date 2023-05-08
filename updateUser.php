<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location:login.php');
}
include './head.php';
include './classes/userClass.php';
$user = new User();
$u_id = $_GET['id'];
$userList = $user->getUsers("id=$u_id");
$row = $userList->fetch();
$name = $row['name'];
$email = $row['email'];
$gender = $row['gender'];
$username = $row['username'];
$profile_image = $row['profile_image'];
?>
<?php

if (isset($_POST['update'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $gender = $_POST["gender"];
    $username = $_POST['username'];
    $cpassword = $_POST['cpassword'];
    $currentPassword = $_POST['currentPassword'];


    $user = new User();

    if (isset($_FILES)) {
        $fileName = $_FILES['profile']['name'];
        $tempPath = $_FILES["profile"]["tmp_name"];
        $profile_image = $fileName;
    }
    if ($password) {
        $res = $user->verifyPassword($email, $currentPassword);
        if ($res) {

            $res = $user->update($u_id, $name, $email, $username, $password, $gender, $profile_image);
            if ($res) {
                $result = move_uploaded_file($tempPath, "uploads/user/" . $profile_image);
                header("Location: logout.php");
            } else {
                echo 'err';
            }
        } else {
            $passwordError = "Current password is Wrong";
            $cpassword = '';
            $password = '';
        }
    } else {
        $res = $user->update($u_id, $name, $email, $username, null, $gender, $profile_image);

        if ($res) {
            $result = move_uploaded_file($tempPath, "uploads/user/" . $profile_image);
            header("Location: dashboard.php");
        } else {
            $cpassword = $username = $name = $email = $password = $city = $gender = "";
            echo 'errr';
        }
    }
}
?>

<body>
    <div id="pageloader">
        <img src="http://cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif"
            alt="processing..." />
    </div>
    <header>
        <div class="container">
            <div class="header-container">
                <div class="title-part">
                    <div class="title">
                        <a href="./index.php">
                            <h3><span>OSM</span>Blog</h3>
                        </a>
                    </div>
                    <div class="nav-links">
                        <a href="./dashboard.php">Dashboard</a>
                        <a href="./uploadBlog.php">Create New Blog</a>
                        <a href="./updateUser.php?id=<?php echo $uid ?>" class="active">Update Details</a>
                    </div>
                </div>
                <div class="login-part">
                    <a href="./logout.php" class="btn btn-outline-danger">Log out</a>
                </div>
                <div class="hamburger">
                    <div class="icon-div">
                        <img src="./assets/img/menu.png" alt="" width='20' id="hamburger-icon">
                    </div>
                    <div id="links">
                        <div id="close-menu">
                            <img src="./assets/img/close.png" alt="" width="20" id="close-menu-icon">
                        </div>
                        <div class="links-bar">
                            <a href="./dashboard.php"><span>Dashboard</span></a>
                            <a href="./uploadBlog.php"><span>Create New Blog</span></a>
                            <a href="./updateUser.php?id=<?php echo $uid ?>" class="active"><span>Update
                                    Details</span></a>
                            <a href="./logout.php"><span class="btn btn-danger">Log out</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Begin Site Title
================================================== -->
    <div class="container">
        <div class="mainheading" style="margin-top: 20px">
            <h1 class="sitetitle">Be a part of OSM Team</h1>
        </div>
        <!-- End Site Title
================================================== -->

        <!-- Begin Featured
    ================================================== -->
        <section class="featured-posts">
            <div class="section-title container">
                <h2><span>Update Your Profile</span></h2>
            </div>
        </section>

        <section>
            <div class="container">
                <form class="update-form" id="form" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group col-md-8">
                                <label for="inputEmail4">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name" value="<?php if (isset($name)) {
                                    echo $name;
                                } ?>" />
                                <span class="error" id="emailError"></span>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="inputEmail4">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email" value="<?php if (isset($email)) {
                                    echo $email;
                                } ?>" readonly />
                                <span class="error" id="emailError">
                                    <?php echo $emailError ?>
                                </span>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="inputEmail4">Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Username" value="<?php if (isset($username)) {
                                    echo $username;
                                } ?>" readonly />
                                <span class="error" id="UsernameError">
                                    <?php echo $userNameError ?>
                                </span>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="inputEmail4">Gender :&nbsp;</label>
                                <input type="radio" name="gender" value="male" <?php
                                if ($gender == "male") {
                                    echo "checked";
                                }
                                ?> />
                                Male&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="gender" value="female" />
                                Female&nbsp;&nbsp;&nbsp;<label id="gender-error" class="error" for="gender"
                                    style="display:contents;" <?php
                                    if ($gender == "female") {
                                        echo "checked";
                                    }
                                    ?>></label>
                                <span class="error" id="genderError"></span>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="">Wants to Change Password</label> &nbsp;&nbsp;<input type="checkbox"
                                    id="password-checkbox" <?php if ($currentPassword) {
                                        echo 'checked';
                                    } ?>>
                            </div>
                            <div class="password-container" style=" display: none;">
                                <div class="form-group col-md-8">
                                    <label for="inputPassword4">Current Password</label>
                                    <input type="password" class="form-control" id="currentPassword"
                                        name="currentPassword" placeholder="Current Password" value="<?php if (isset($password)) {
                                            echo $password;
                                        } ?>" />
                                    <span class="error" id="passwordError">
                                        <?php echo $passwordError ?>
                                    </span>
                                </div>

                                <div class="form-group col-md-8">
                                    <label for="inputPassword4">New Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="New Password" value="<?php if (isset($password)) {
                                            echo $password;
                                        } ?>" />
                                    <span class="error" id="passwordError"></span>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="inputPassword4">Confirm New Password</label>
                                    <input type="password" class="form-control" id="cpassword" name="cpassword"
                                        placeholder="confirm New password" value="<?php if (isset($cpassword)) {
                                            echo $cpassword;
                                        } ?>" />
                                    <span class="error" id="cpasswordError"></span>
                                </div>
                            </div>

                            <div class="form-group col-md-8">
                                <div class="form-group">
                                    <img src="./uploads/user/<?php echo $profile_image ?>" id="avatar" alt="">
                                </div>
                                <div>
                                    <label for="inputEmail4">Profile</label>
                                    <input type="file" class="form-control" id="profile" value="<?php if (isset($_FILES)) {
                                        echo true;
                                    } ?>" name="profile" placeholder="Upload Profile" />
                                    <span class="error" id="profileError"></span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" style="margin-left: 20px;"
                                name="update">Update
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </section>
    </div>
    <?php include './footer.php' ?>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="./assets/js/script2.js"></script>
<script src="./assets/js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>