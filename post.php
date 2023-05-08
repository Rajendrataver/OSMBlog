<?php
session_start();

include './classes/blogClass.php';
require_once './classes/commentClass.php';
$blog = new Blog();

$blog_id = $_GET['id'];
$sql = $blog->getBlog("id=$blog_id");
$row = $sql->fetch();
$cat_id = $row['category'];
$title = $row['title'];
$a_id = $row['aid'];
$short_note = $row['short_note'];
$descrition = $row['description'];
$upload_date = $row['upload_date'];
$author = $row['author'];
$banner_image = $row['banner_image'];
$author_image = $row['author_image'];

if ($author_image == "") {
  $author_image = 'user.png';
}

$commentList = new Comment();
$sql = $commentList->getComments($blog_id);
if (isset($_GET['submit-comment'])) {
  $comment = $_GET['comment'];
  $blog_id = $_GET['id'];

  if (!isset($_SESSION['email'])) {
    header('Location:login.php');
  } else {
    if ($comment) {
      $commentList->addComment($comment, $_SESSION['id'], $blog_id);
      header("Location:post.php?id=$blog_id");
    }
  }
}


if (isset($_GET['remove-comment'])) {
  $comment_id = $_GET['comment_id'];
  $commentList->deleteComment($comment_id);
  header("Location:post.php?id=$blog_id");
}
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
          <div class="nav-links">
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
  <!-- Begin Article
================================================== -->
  <div class="container">
    <div class="row">
      <!-- Begin Post -->

      <div class="col-md-12 col-md-offset-2 col-xs-12">
        <div class="mainheading" style="margin-bottom: 0;">
          <div class="section-title">
            <h2><span>
                <?php echo $title ?>
              </span>
            </h2>
          </div>
        </div>

        <!-- Begin Featured Image -->
        <div>
          <img class="featured-image img-fluid" src="./uploads/blog/<?php echo $banner_image ?>" alt="" />
        </div>
        <div class="author-section">
          <div class="row post-top-meta">
            <div class="col-md-12 flex">
              <a href='./author.php?id=<?php echo $a_id; ?>' class='auther'>
                <div class='avatar'>
                  <img src='./uploads/user/<?php echo $author_image ?>' alt=''>
                </div>
                <div class='author-part'>
                  <h2 style="margin: 0;">
                    <?php echo $author ?>
                  </h2>
                  <span style='margin=0;'>Date :
                    <?php echo $upload_date; ?>
                  </span>
                </div>
              </a>
            </div>
          </div>
        </div>
        <!-- End Featured Image -->
        <div class="article-post">
          <h3>
            <?php echo $short_note ?>
          </h3>
          <p>
            <?php echo $descrition ?>
          </p>
        </div>
        <!-- End Post Content -->
      </div>

      <!-- End Post -->
    </div>
  </div>


  <section class="read-comment-section">
    <div class="container ">
      <h2 style="margin-bottom: 50px;">Comments</h2>
      <div class="comment-section-drope">

        <div class='comments-container'>
          <div class="drop-comment">
            <h3>Add a Comment</h3>
            <form methode='post'>
              <input type="text" name="id" value="<?php echo $blog_id ?>" style="display: none;">
              <input name="comment" id="" cols="30" rows="10" placeholder='Ente A comment.....'>
              <button type="submit" name="submit-comment" class="btn btn-primary comment-btn"
                value="submit">Comment</button>
            </form>
          </div>
          <?php
          while ($row = $sql->fetch()) {



            $user_id = $row['user_id'];
            $author_image = $row['user_image'];
            $author = $row['name'];
            $upload_date = $row['comment_date'];
            $comment_id = $row['comment_id'];
            $comment = $row['comment'];
            $id = $row['blog_id'];
            if ($author_image == "") {
              $author_image = 'user.png';
            }
            $display = 'none';
            if ($user_id == $_SESSION['id']) {
              $display = 'block';
            }
            echo "<div class='comment-item'>
                   <div class='author-section'>
                    <div class='comment-remove'>
                       <a href='./author.php?id=$user_id' class='auther'>
                       <div class='avatar'>
                        <img src='./uploads/user/$author_image' alt=''>
                       </div>
                       <div class='author-part'>
                       <h5 style='margin: 0;'>
                       $author 
                       </h5>
                       <span style='margin=0; color: gray;font-size:12px'>Date :
                       $upload_date
                       </span>
                       <p>
                       $comment
                      </p>
                    </div>
                     </a>
                   <form style='display:$display'>
                   <input type='text' name='id' value= $blog_id style='display: none;'>
                   <input type='text' name='comment_id' value=$comment_id style='display: none;'>
                    <button type=submit class='btn btn-danger' name='remove-comment' value='remove'>Remove</button>
                  </form> 
            </div>
            
          </div>
          
          <hr/>
        </div>";
          }
          ?>
        </div>

      </div>

    </div>
  </section>

  <section class="featured-posts">
    <div class="section-title container">
      <h2><span>Related Blog</span></h2>
    </div>
  </section>
  <section class="related-item">
    <div class="container">
      <div class="blog-container">
        <?php
        $count = 0;
        $sql = $blog->getBlog(null);
        while ($row = $sql->fetch()) {

          $title = $row['title'];
          $short_note = $row['short_note'];
          $upload_date = $row['upload_date'];
          $teaser_image = $row['teaser_image'];
          $author_image = $row['author_image'];
          $id = $row['id'];
          $category = $row['category'];
          $a_id = $row['aid'];

          if ($id != $blog_id && $cat_id == $category) {
            $count++;
            echo "<div class='blog'>
						<div class='teaser-img'>
							<img src='./uploads/blog/$teaser_image' alt='' />
						</div>
						<div class='blog-details'>
            
							<h3><a href='./post.php?id=$id'>$title</a></h3>
							<p>$short_note</p>
								
						</div>
					</div>";
          }
          if ($count == 2) {
            break;
          }
        }
        ?>

      </div>
    </div>
  </section>


  <?php include './footer.php' ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="./assets/js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>