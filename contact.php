<?php
session_start();
include './head.php';
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
                        <a href="./contact.php" class="active">Contact</a>
                    </div>
                </div>
                <div class="login-part">
                    <?php
                    if (isset($_SESSION['email'])) {
                        echo "<a href='./dashboard.php' class='btn btn-outline-success'>dashboard</a>&nbsp;&nbsp;&nbsp;<a href='./logout.php'
						class='btn btn-outline-danger'>Log-out</a>";
                    } else {
                        echo "<a href='./login.php' class='btn btn-success'>Log-in</a>&nbsp;&nbsp;&nbsp;<a href='./register.php'
						class='btn btn-outline-primary'>Sign up with us</a>";
                    }
                    ?>
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
                            <a href="./contact.php" class="active"><span>Contact</span></a>
                            <?php
                            if (isset($_SESSION['email'])) {
                                echo "<a href='./logout.php'
						><span class='btn btn-danger'>Log-out</span></a><a href='./dashboard.php'><span class='btn btn-success'>dashboard</sapn></a>";
                            } else {
                                echo "<a href='./login.php' ><span class='btn btn-success'>Log-in</span></a><a href='./register.php'
						><span class='btn btn-primary'>Sign up with us</span></a>";
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
            <h1 class="sitetitle">Contact Us...</h1>
            <p class="lead">
                “Not only are bloggers suckers for the remarkable, so are the people who read blogs.”
            </p>
        </div>
        <!-- End Site Title
================================================== -->

        <!-- Begin Featured
    ================================================== -->


        <section>
            <div class="contact-container">
                <div class="contact-img">
                    <img src="./assets/img/map.webp" class="img-fluid" alt="">
                </div>
                <form method="post" class="contact-form" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col-md-11">
                            <input type="email" class="form-control" name="email" placeholder="Email" />

                        </div>
                        <div class="col-md-11" style="margin-top: 20px;">
                            <input type="text" class="form-control" name="massege" placeholder="Leave a massege" />

                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin: 20px;display:block" name="signup">Send
                    </button>
                </form>

            </div>
            <div style="margin-top:100px">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati ut vero esse officiis. Rerum
                    vitae ut natus quas culpa obcaecati nesciunt, animi aperiam aspernatur adipisci doloribus nobis
                    omnis voluptatum repudiandae, libero exercitationem sunt vel aliquid alias sequi debitis?
                    Tenetur, qui, sit magni vel iure aperiam dicta aspernatur laboriosam natus sed molestias
                    adipisci. Hic blanditiis voluptates sint commodi, similique quisquam numquam eius, cum porro
                    obcaecati inventore, suscipit corporis molestias libero quia sapiente facere! Ratione similique
                    quos, vitae quisquam dolorum esse facere, fuga perferendis nesciunt mollitia consequatur debitis
                    et sint eaque reprehenderit atque cumque eligendi deserunt ipsum porro aliquid hic! Voluptatem
                    distinctio maxime ab minima fuga impedit modi ipsa commodi optio, eligendi voluptate eaque
                </p>
            </div>
        </section>
    </div>
    <?php include './footer.php' ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="./assets/js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="./assets/js/pagination.js"></script>

</html>