<?php
include './head.php';
include './classes/userClass.php';
?>
<?php

if (isset($_POST['signup'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $gender = $_POST["gender"];
    $city = $_POST['city'];
    $username = $_POST['username'];
    $cpassword = $_POST['cpassword'];

    $user = new User();

    if ($user->is_already("email='$email'")) {
        $email = "";
        $emailError = 'Email Already Registered';
    } else if ($user->is_already("username='$username'")) {
        $username = '';
        $userNameError = 'username Already Registered';
    } else {
        $profile_image = null;
        $emailError = '';
        if (isset($_FILES)) {
            $fileName = $_FILES['profile']['name'];
            $tempPath = $_FILES["profile"]["tmp_name"];
            $profile_image = $fileName;
        }
        $res = true;
        $res = $user->register($name, $email, $username, $password, $gender, $profile_image);
        if ($res) {
            $cpassword = $username = $name = $email = $password = $city = $gender = "";
            $_POST['signup'] = null;
            $result = move_uploaded_file($tempPath, "uploads/user/" . $profile_image);
            header('Location: emailRedirect.php');
        } else {
            $emailError = "Invalid Email Address can't get";
            $cpassword = $username = $name = $email = $password = $city = $gender = "";
        }
    }
}
?>

<body style="position: relative;">
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
                        <a href="./index.php">Home</a>
                        <a href="./about.php">About</a>
                        <a href="./contact.php">Contact</a>
                    </div>
                </div>
                <div class="login-part">
                    <a href="./login.php" class="btn btn-success">Log-in</a>
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
                            <a href="./index.php"><span>Home</span></a>
                            <a href="./about.php"><span>About</span></a>
                            <a href="./contact.php"><span>Contact</span></a>
                            <?php
                            if (isset($_SESSION['email'])) {
                                echo "<a href='./logout.php'
						><span class='btn btn-danger'>Log-out</span></a><a href='./dashboard.php'><span class='btn btn-success'>Back to dashboard</sapn></a>";
                            } else {
                                echo "<a href='./login.php' ><span class='btn btn-success'>Log-in</span></a>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Begin Site Title
================================================== -->
    <div class="container">
        <div class="mainheading">
            <h1 class="sitetitle">Be a part of OSM Team</h1>
        </div>
        <!-- End Site Title
================================================== -->

        <!-- Begin Featured
    ================================================== -->
        <section class="featured-posts">
            <div class="section-title container">
                <h2><span>Register Here</span></h2>
            </div>
        </section>

        <section>
            <div class="container">
                <form class="register-form" id="form" method="post" enctype="multipart/form-data">
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
                                } ?>" />
                                <span class="error" id="emailError">
                                    <?php echo $emailError ?>
                                </span>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="inputEmail4">Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Username" value="<?php if (isset($username)) {
                                    echo $username;
                                } ?>" />
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
                                <label for="inputPassword4">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" value="<?php if (isset($password)) {
                                        echo $password;
                                    } ?>" />
                                <span class="error" id="passwordError"></span>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="inputPassword4">Confirm</label>
                                <input type="password" class="form-control" id="cpassword" name="cpassword"
                                    placeholder="confirm password" value="<?php if (isset($cpassword)) {
                                        echo $cpassword;
                                    } ?>" />
                                <span class="error" id="cpasswordError"></span>
                            </div>
                            <div class="form-group col-md-8">
                                <div class="form-group">
                                    <img src="" id="avatar" alt="">
                                </div>
                                <div>
                                    <label for="inputEmail4">Profile</label>
                                    <input type="file" class="form-control" id="profile" value="<?php if (isset($_FILES)) {
                                        echo true;
                                    } ?>" name="profile" placeholder="Upload Profile" />
                                    <span class="error" id="profileError"></span>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary" style="margin-left: 20px;" name="signup">Sign
                                up
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
<script src="./assets/js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>