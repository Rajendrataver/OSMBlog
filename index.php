<?php
session_start();
include './head.php';
require_once './classes/blogClass.php';
require_once './classes/commentClass.php';
$blog = new Blog();
$category = $blog->getCategory(null);
$categoryCondition = $_GET['category'];
$flag = true;
if ($categoryCondition) {
	$catid = $blog->getCategory("category='$categoryCondition'");
	$catid = $catid->fetch();
	$id = $catid['id'];
	$sql = $blog->getBlog("category=$id");
} else {
	$sql = $blog->getBlog(null);
}
$user_image = 'male1.jpg';

if ($_SESSION['profile_image']) {
	$user_image = $_SESSION['profile_image'];
}
$commentList = new Comment();
if (isset($_POST['submit_comment'])) {
	$comment = $_POST['comment'];
	$blog_id = $_POST['blog_id'];

	if (!isset($_SESSION['email'])) {
		header('Location:login.php');
	} else {
		if ($comment) {
			$commentList->addComment($comment, $_SESSION['id'], $blog_id);
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
						<a href="./index.php" class="active">Home</a>
						<a href="./about.php">About</a>
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
							<a href="./index.php" class="active"><span>Home</span></a>
							<a href="./about.php"><span>About</span></a>
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
			<h1 class="sitetitle">Conversation is king.</h1>
			<p class="lead">
				Content is just something to talk about
			</p>
		</div>
		<!-- End Site Title
================================================== -->

		<!-- Begin Featured
	================================================== -->
		<section class="featured-posts">
			<div class="section-title">
				<h2><span>Featured</span></h2>
			</div>
		</section>

		<section class="index-blog">
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
						$a_id = $row['aid'];
						if ($author_image == "") {
							$author_image = 'user.png';
						}

						echo "
						
						<div class='blog'>
						<div class='blog-item'>
						<div class='teaser-img'>
							<img src='./uploads/blog/$teaser_image' alt='' />
						</div>
						<div class='blog-details'>
							<h3><a href='./post.php?id=$id'>$title</a></h3>
							<p>$short_note</p>
						
								<a href='./author.php?id=$a_id' class='auther'>
								<div class='avatar'>
									<img  src='./uploads/user/$author_image' alt=''>
								</div>
								<div class='author-part'>
								<h5>$author</h5>
								 <span style='margin=0;color: rgba(0, 0, 0, .6);'>Date:- $upload_date</span>
								</div>
								</a>
						</div>
						</div>
						<div class='comment-section'>
						  
						  <form method='post'>
						  <div>
            
                         <a href='./dashboard.php'>
                         <div class='avatar'>
                          <img src='./uploads/user/$user_image' alt=''>
                         </div>
                         </a>
          
                         </div>
						  <input type='number' value='$id' name='blog_id'style='display:none'/>
						  <input type='text' placeholder='Comment.....' name='comment'><button type='submit' name='submit_comment' class='btn btn-primary'>comment</button> 
						  </form>
						</div>
					</div>
					
					";
					}
					if ($flag) {
						include './404.php';
					}
					?>

				</div>
			</div>
		</section>
		<div id="nav"></div>
	</div>
	<?php include './footer.php' ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="./assets/js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="./assets/js/pagination.js"></script>

</html>