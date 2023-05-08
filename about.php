<?php
session_start();
include './head.php';
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
                        <a href="./about.php" class="active">About</a>
                        <a href="./contact.php">Contact</a>
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
                            <a href="./about.php" class="active"> <span>About</span></a>
                            <a href="./contact.php"><span>Contact</span></a>
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
            <h1 class="sitetitle">About Us</h1>
            <p class="lead">
                “Not only are bloggers suckers for the remarkable, so are the people who read blogs.”
            </p>
        </div>
        <!-- End Site Title
================================================== -->

        <!-- Begin Featured
    ================================================== -->
        <section>
            <div>
                <img class="featured-image img-fluid" src="./uploads/user/4.jpg" alt="" />
            </div>
            <p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Placeat iste eaque voluptatum quo inventore
                quasi deleniti fugiat harum hic, accusamus et culpa nam quaerat tempora necessitatibus tenetur corporis
                quas suscipit reprehenderit excepturi enim voluptatibus cumque, qui ullam! Recusandae debitis, officiis
                facere voluptatibus enim animi non facilis praesentium inventore corrupti, esse delectus eius quasi
                aperiam ratione nostrum, vel sed cumque harum. Consequuntur inventore dolorum rem delectus eveniet eum
                ut aut facere corrupti, voluptates, accusantium temporibus, quod totam! Rerum aperiam sapiente assumenda
                rem unde animi sequi laudantium ullam corrupti quis nulla accusamus placeat sint officiis incidunt
                consequatur dolore tempore iusto esse quaerat, culpa sed. Dignissimos modi ab cupiditate accusamus,
                dolorem expedita eos reprehenderit voluptate blanditiis nemo fugiat a facilis laboriosam optio
                repudiandae deserunt maiores, magnam incidunt nihil eum animi. Nisi architecto cumque debitis optio
                laboriosam eius excepturi, ducimus nesciunt porro repellendus perferendis ullam delectus exercitationem
                consequuntur quam dicta quidem iste maiores aliquam veniam! Tempore perspiciatis soluta vel earum,
                deserunt expedita corrupti excepturi eum inventore asperiores provident ut doloribus deleniti, impedit,
                minus similique. Fugit voluptatem deleniti vitae enim mollitia, distinctio incidunt eligendi laboriosam
                repellendus suscipit modi exercitationem est molestias iure fugiat sint architecto quaerat nesciunt?
                Optio provident enim ipsa aliquam sit eaque neque.
            </p>
        </section>

        <section>

        </section>
    </div>
    <?php include './footer.php' ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="./assets/js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="./assets/js/pagination.js"></script>

</html>