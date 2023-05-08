<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location:login.php');
}


include './classes/blogClass.php';
$blog = new Blog();

$uid = $_SESSION['id'];

$category = $blog->getCategory(null);
$categoryCondition = $_GET['category'];
if ($categoryCondition) {
    $catid = $blog->getCategory("category='$categoryCondition'");
    $catid = $catid->fetch();
    $id = $catid['id'];
    $sql = $blog->getBlog("category=$id and author=$uid");
} else {
    $sql = $blog->getBlog("author=$uid");
}
$flag = true;
$author_image = $row['author_image'];

?>
<?php
include './head.php';
?>

<body>
    <header>
        <div class="container">
            <div class="header-container">
                <div class="title-part">
                    <div class="title">
                        <a href="./index.php">
                            <h3><span>OSM</span>Blog</h3>
                        </a>
                    </div>
                    <div class="menu">
                        <form id="category-form">
                            <select id="categoryFilter" name="category">
                                <option value="">Categories</option>
                                <?php
                                while ($row = $category->fetch()) {
                                    $cat = $row['category'];
                                    if ($categoryCondition == $cat)
                                        echo "<option selected>$cat</option>";
                                    else {
                                        echo "<option>$cat</option>";
                                    }
                                }
                                ?>
                            </select>
                            <input type="submit" name="category-submit" style="display: none;">
                        </form>
                    </div>
                    <div class="nav-links">
                        <a href="./dashboard.php" class="active">Dashboard</a>
                        <a href="./uploadBlog.php">Create New Blog</a>
                        <a href="./updateUser.php?id=<?php echo $uid ?>">Update Details</a>
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
                            <a href="./dashboard.php" class="active"><span class="active">Dashboard</span></a>
                            <a href="./uploadBlog.php"><span>Create New Blog</span></a>
                            <a href="./updateUser.php?id=<?php echo $uid ?>"><span>Update Details</span></a>
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
        <div class="mainheading" style="margin-top:20px">
            <h1 class="sitetitle">Welcome
                <?php echo $_SESSION['name']; ?>
            </h1>
        </div>
        <!-- End Site Title
================================================== -->

        <!-- Begin Featured
    ================================================== -->
        <section class="featured-posts">
            <div class="section-title container">
                <h2><span>My Blogs</span></h2>
            </div>
        </section>
    </div>

    <section class="dashboard-blog">
        <div class="container">
            <div class="blog-container">
                <?php
                while ($row = $sql->fetch()) {
                    $flag = false;
                    $title = $row['title'];
                    $short_note = $row['short_note'];
                    $upload_date = $row['upload_date'];
                    $author = $row['author'];
                    $teaser_image = $row['teaser_image'];
                    $author_image = $row['author_image'];
                    $id = $row['id'];
                    $category = $row['category'];
                    if ($author_image == "") {
                        $author_image = 'user.png';
                    }

                    echo "<div class='blog'>
                    
						<div class='teaser-img'>
                        
							<img src='./uploads/blog/$teaser_image' alt='' />
						</div>
						<div class='blog-details'>
                           <hr>
							<h3 ><a href='./post.php?id=$id'>$title</a> </h3>
							<p>$short_note</p>
							<div class='auther'>
								<span style='margin=0;'>Date:- $upload_date</span>
							</div>
                            <hr/>
                            <div class='blog-action'>
                             <a href='./editBlog.php?id=$id' class='edit-blog'>Edit <i class='fa fa-pencil' aria-hidden='true'></i></a>
                             <a href='./confirmDelete.php?id=$id'><img src='./assets/img/remove.png' width='30'></a>
                            </div>
                        
						</div>
					</div>";
                }
                if ($flag) {
                    include './404.php';
                }
                ?>

            </div>
            <div id="nav"></div>
        </div>
    </section>
    <?php include './footer.php' ?>

</body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js">
    <script src="./assets/js/javascript.js"></script>
<script src="./assets/js/script.js"></script>
<script src="./assets/js/pagination.js"></script>