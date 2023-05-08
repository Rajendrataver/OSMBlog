<?php
session_start();
include './classes/blogClass.php';
$blog = new Blog();
$a_id = $_GET['id'];
$category = $blog->getCategory(null);
$categoryCondition = $_GET['category'];
if ($categoryCondition) {
	$catid = $blog->getCategory("category='$categoryCondition'");
	$catid = $catid->fetch();
	$id = $catid['id'];
	$sql = $blog->getBlog("category=$id and author=$a_id");
} else {
	$sql = $blog->getBlog("author=$a_id");
}
$flag = true;
$author = $blog->getBlog("author=$a_id");
$author = $author->fetch();
$author_image = $author['author_image'];
$author_name = $author['author'];
$author_email = $author['email'];
if ($author_image == "") {
	$author_image = 'user.png';
}
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
					<div class="nav-links">
						<div class="menu">
							<form id="category-form">
								<input type="text" name="id" value="<?php if (isset($a_id)) {
									echo $a_id;
								}
								?>" style="display: none;">
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
						<a href="./index.php">Home</a>
						<a href="./about.php">About</a>
						<a href="./contact.php">Contact</a>
					</div>
				</div>
				<div class="login-part">
					<?php
					if (isset($_SESSION['email'])) {
						echo "<a href='./dashboard.php' class='btn btn-outline-success'>Dashboard</a>&nbsp;&nbsp;&nbsp;<a href='./logout.php'
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
							<a href="./contact.php"><span>Contact</span></a>
							<?php
							if (isset($_SESSION['email'])) {
								echo "<a href='./logout.php'
						><span class='btn btn-danger'>Log-out</span></a><a href='./dashboard.php'><span class='btn btn-success'>Dashboard</sapn></a>";
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

	<section class="auther-section">
		<div class="container">
			<div style="width: 70%;margin-top:50px">

				<div class="row post-top-meta">
					<div class="col-md-12 flex">
						<a href='./author.php?id=<?php echo $a_id; ?>' class='auther'>
							<div class='avatar'>
								<img src='./uploads/user/<?php echo $author_image ?>' alt=''>
							</div>
							<div class='author-part'>
								<h2 style="margin: 0;">
									<?php echo $author_name ?>
								</h2>
								<span style='margin=0;white-space:wrap;font-size:22px'>
									<?php echo $author_email; ?>
								</span>
							</div>
						</a>
					</div>
				</div>

			</div>
		</div>
	</section>
	<section class="featured-posts">
		<div class="container">
			<div class="section-title">
				<h2><span>Blogs</span></h2>
			</div>
		</div>
	</section>
	<section class="author-blog">
		<div class="container">
			<div class="blog-container">
				<?php
				while ($row = $sql->fetch()) {
					$flag = false;
					$title = $row['title'];
					$short_note = $row['short_note'];
					$upload_date = $row['upload_date'];
					$teaser_image = $row['teaser_image'];
					$author_image = $row['author_image'];
					$id = $row['id'];
					$category = $row['category'];
					$a_id = $row['aid'];

					echo "<div class='blog'>
						<div class='teaser-img'>
							<img src='./uploads/blog/$teaser_image' alt='' />
						</div>
						<div class='blog-details'>
						<hr/>
							<h3><a href='./post.php?id=$id'>$title</a></h3>
							<p>$short_note</p>
								<div class='author-part'>
								<span style='margin=0;'>Date:- $upload_date</span>
								</div>
						</div>
					</div>";
				}
				if ($flag) {
					include './404.php';
				}
				?>

			</div>

		</div>
		<div id="nav"></div>
	</section>

	<?php @include './footer.php' ?>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="./assets/js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="./assets/js/pagination.js"></script>