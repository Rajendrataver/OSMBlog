<?php
session_start();
if (isset($_SESSION['email'])) {
    header("Location: dashboard.php");
}
include './head.php';
include './classes/userClass.php';

if (isset($_POST['login'])) {

    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($email)) {
        $emailError = 'Email or username is required';

    }
    if (empty($password)) {
        $passwordError = 'Password is Reuired';

    } else {

        $user = new User();
        $res = $user->login($email, $password);
        $email = $password = '';
        if ($res) {
            echo 'login';
            $_SESSION['name'] = $res['name'];
            $_SESSION['email'] = $res['email'];
            $_SESSION['id'] = $res['id'];
            $_SESSION['profile_image'] = $res['profile_image'];

            header("Location: dashboard.php");

        } else {
            $emailError = 'Invalid User or unverified';
        }
    }
}
?>

<body style="position: relative;">
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
						><span class='btn btn-danger'>Log-out</span></a><a href='./dashboard.php'><span class='btn btn-success'>dashboard</sapn></a>";
                            } else {
                                echo "<a href='./register.php'
						><span class='btn btn-primary'>Sign up with us</span></a>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="login-part">
                    <?php
                    if (isset($_SESSION['email'])) {
                        echo "<a href='./dashboard.php' class='btn btn-outline-success'>dashboard</a>&nbsp;&nbsp;&nbsp;<a href='./logout.php'
						class='btn btn-outline-danger'>Log-out</a>";
                    } else {
                        echo "<a href='./register.php'
						class='btn btn-outline-primary'>Sign up with us</a>";
                    }
                    ?>
                </div>

            </div>
        </div>
    </header>
    <!-- Begin Site Title
================================================== -->
    <div class="container">
        <div class="mainheading">
            <h1 class="sitetitle">Welcome To OSMBLog</h1>
        </div>
        <!-- End Site Title
================================================== -->

        <!-- Begin Featured
    ================================================== -->
        <section class="featured-posts">
            <div class="section-title container">
                <h2><span>Login Here</span></h2>
            </div>
        </section>

        <section>
            <div class="container">
                <form class="form" id="login-form" method="post">
                    <div class="login-form">
                        <div>
                            <label for="inputEmail4">Email/username</label>
                            <input type="text" class="form-control" name="email" placeholder="Email/username" value="<?php if (isset($email)) {
                                echo $email;
                            } ?>" />
                            <label id="email-error" class="error" style="display: none;" for="email">
                                <?php echo $emailError; ?>
                            </label>
                        </div>

                        <div style="margin-top:10px">
                            <label for="inputPassword4">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" value="<?php if (isset($password)) {
                                echo $password;
                            } ?>" />
                            <span class="error" id="passwordError">
                                <?php echo $passwordError ?>
                            </span>
                            <button type="submit" class="btn btn-success" name="login"
                                style="margin-top:20px;display:block">Login</button>
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
<script src="./assets/js/javascript.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>