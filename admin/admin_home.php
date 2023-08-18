<?php
  session_start();
  include "../req_count.php";
  include "../db_connect.php";

  if(isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == "Active") {

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior Home Page</title>
    <script src="admin_script.js"></script>
    <link rel="stylesheet" href ="../layout.css?v=<?php echo time(); ?>">
    
  </head>
  <body class="background">
  <div class="top-nav">
    <h1>Senior Citizen System</h1>
  </div>

  <div class="main-div">

    <div class="left-div">

      <button class="left-button" id="Active" onclick="home_function()">
        <span class="material-symbols-outlined">
          home
        </span>
        <p>Home</p>
      </button>

      <button class="left-button" onclick="view_emp()" >
        <span class="material-symbols-outlined">
          person
        </span>
        <p>Users</p>
      </button>

      <button class="left-button" onclick="view_senior()">
        <span class="material-symbols-outlined">
          elderly
        </span>
        <p>Seniors</p>
      </button>

      <button class="left-button" onclick="view_requests()">
        <span class="material-symbols-outlined">
          description
        </span>
        <p>Requests</p>
        <?php
          if($row_count > 0){

        ?>
        <div id="req-notif">
          <?= $row_count ?>
        </div>
        <?php
          }
        ?>
      </button>

      <button class="logout-button" onclick="logout_function()">
        <span class="material-symbols-outlined">
          logout
        </span>
        <p>Logout</p>
      </button>
    </div>

    <?php
      #select everything from the post table
      $sql_post = mysqli_query($conn, "SELECT * FROM post_tbl P INNER JOIN emp_tbl E ON P.emp_id = E.emp_id");
      $post_row = mysqli_num_rows($sql_post);
    ?>
    
    <div class="home-div">

      <div class="add-post">
        <div class="top-post">
          <img src="user_pics/__id_pic.jpg" alt="" class="profile-pic">
          <input type="text" placeholder="Create an Event" id="create-button">
        </div>
      </div>

      <!-- this is the modal for the birth certificate -->
      <div id="postModal" class="modal">

      <!-- Modal content -->
        <div class="create-content">
          <div class="create-header">
            <span class="close">&times;</span>
            <h2>Create Post</h2>
          </div>
          <div class="create-body">
            <img src="../user/requests/birth_certificate/<?= $row['birth_certificate'] ?>" alt="">
          </div>
        </div> 

      </div>

      <?php
        if($post_row > 0) {
          while($row = mysqli_fetch_array($sql_post)){

      ?>

      <div class="post">
        <div class="title">
          <div class="post-profile">
            <img src="user_pics/<?= $row['id_pic'] ?>" alt="" class="profile-pic">
          </div>
          <div class="who-post">
            <h3 class="post-head"><?= $row['full_name'] ?></h3>
            <p class="post-head"><?= $row['post_type'] ?></p>
          </div>
        </div>

        <div class="post-details">
          <p><?= $row['post_description'] ?></p>
        </div>

        <div class="post-pic">
          <img src="../user/posts/post_pics/<?= $row['post_pic'] ?>" alt="" class="da-pic">
        </div>
      </div>
      <?php
          }
        }

        elseif($post_row == 0) {

      ?>

      <div class="no-posts">
        there are no posts
      </div>

      <?php
        }
      ?>

    </div>

    <div class="right-div">

      <h1>this is the right div</h1>

    </div>

  </div>
  

  </body>

  <script>
        // Get the modal
    var modal = document.getElementById("postModal");

    // Get the button that opens the modal
    var btn = document.getElementById("create-button");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
      modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>
</html>
<?php
  }
  else {
    header("Location: admin_login.php");
  }
?>