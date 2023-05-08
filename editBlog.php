<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include "./classes/blogClass.php";
if (!isset($_SESSION['email'])) {
    header('Location:login.php');
}
$blog = new Blog();
$categoryList = $blog->getCategory(null);
$id = $_GET['id'];
$sql = $blog->getBlog("id=$id");
$row = $sql->fetch();
$title = $row['title'];
$category = $row['category'];

$description = $row['description'];
$teaser_image = $row['teaser_image'];
$banner_image = $row['banner_image'];

if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $addCategory = $_POST['addCategory'];
    $short_note = substr($description, 0, 100) . ' ...';
    $description = $_POST['description'];

    $file1 = $_FILES['teaserImage']['name'];
    $file2 = $_FILES['bannerImage']['name'];


    $author = $_SESSION['id'];

    if ($addCategory == '' && $category == 'Select') {
        $categoryError = 'Select Category';
    } else {
        if (strlen($addCategory)) {
            $category = $addCategory;
        }
        $categoryError = '';
        $category = strtolower($category);
        if ($file1) {
            $teaser_image = $file1;
            move_uploaded_file($_FILES['teaserImage']['tmp_name'], "uploads/blog/" . $teaser_image);
        }
        if ($file2) {
            $banner_image = $file2;
            move_uploaded_file($_FILES['bannerImage']['tmp_name'], "uploads/blog/" . $banner_image);
        }

        $res = $blog->update($id, $title, $category, $short_note, $author, $teaser_image, $banner_image, $description);
        if ($res) {

            //  $titel = $category = $short_note = $addCategory = $author = $teaser_image = $banner_image = $description = '';

            header('Location: dashboard.php');
        } else {
            echo "<script>alert('error')</script>";
        }
    }
}
?>
<?php
include './head.php';
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
            <h1 class="sitetitle">Every Blog has a different story...</h1>
        </div>
        <!-- End Site Title
================================================== -->

        <!-- Begin Featured
    ================================================== -->
        <section class="featured-posts">
            <div class="section-title container">
                <h2><span>Edit Your Blog</span></h2>
            </div>
        </section>
    </div>

    <section class="login-form-section">
        <div class="container">
            <form method="post" class="blog-form" enctype="multipart/form-data">
                <div class="login-container">
                    <div class="form-group col-md-12">
                        <label for="inputEmail4" style="font-weight: bold;">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title" value="<?php if (isset($title)) {
                            echo $title;
                        } ?>" />
                        <span class="error" id="titleError"></span>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="inputEmail4">Category</label>
                                <select class="form-control" id="category" name="category">
                                    <option>Select</option>
                                    <?php
                                    while ($row = $categoryList->fetch()) {
                                        $cat = $row['category'];
                                        if ($category == $cat)
                                            echo "<option selected>$cat</option>";
                                        else {
                                            echo "<option>$cat</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <span class="error" id="category">
                                    <?php echo $categoryError ?>
                                </span>
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail4">Add</label>
                                <input type="text" class="form-control" name='addCategory' placeholder="Add Category"
                                    id="addCategory" value="<?php if (isset($addCategory)) {
                                        echo $addCategory;
                                    } ?>" <?php if (isset($category)) {
                                         echo 'readonly';
                                     } ?>>
                                <span class=" error" id="category">
                                    <?php echo $emailError ?>
                                </span>
                            </div>
                        </div>

                    </div>

                    <div class="form-group col-md-12" style="margin-top: 35px">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="inputEmail4">Teaser Image</label>
                                <div>
                                    <img src="./uploads/blog/<?php echo $teaser_image ?>" id="preview-teaserImage"
                                        width="100" alt="">
                                </div>
                                <div class="form-group">
                                    <input type="file" class="form-control" id="teaserImage" name="teaserImage"
                                        placeholder="Upload Teaser Image" />
                                    <span class="error" id="teaserImageError"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail4">Banner Image</label>
                                <div>
                                    <img src="./uploads/blog/<?php echo $banner_image ?>" id="preview-bannerImage"
                                        width="100" alt="">
                                </div>
                                <div class="form-group">
                                    <input type="file" class="form-control" id="bannerImage" name="bannerImage"
                                        placeholder="Upload Banner Image" />
                                    <span class="error" id="bannerImageError"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputEmail4">Description</label>
                        <textarea type="text" class="form-control" name="description"
                            placeholder="Describe About The Blog" id="description" rows="8"><?php if (isset($description)) {
                                echo $description;
                            } ?></textarea>
                        <span class="error" id="UsernameError">
                            <?php echo $descriptionError ?>
                        </span>
                    </div>

                    <button type="submit" class="btn btn-success" style="margin-left: 20px;cursor:pointer"
                        name="update">Update
                    </button>&nbsp;&nbsp;
                    <a href="./dashboard.php" class="btn btn-outline-primary">Cancel Update</a>
                </div>
            </form>
        </div>
    </section>
    <?php include './footer.php' ?>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="./assets/js/blog.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

</html>