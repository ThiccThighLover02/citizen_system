<?php
  session_start();
  include "../db_connect.php";

  if(isset($_SESSION['emp_status']) && $_SESSION['emp_status'] == "Active"){
    $this_emp = $conn->prepare("SELECT id_pic FROM emp_tbl WHERE emp_id=?");
      $this_emp->bind_param("i", $_SESSION['emp_id']);
      $this_emp->execute();
      $emp_result = $this_emp->get_result();

      $emp_row = mysqli_fetch_assoc($emp_result);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior Login Page</title>
    <script src="user_script.js"></script>
    <link rel="stylesheet" href ="../layout.css?v=<?php echo time(); ?>">
    
  </head>
  <body class="background">
  <div class="top-nav">
    <h1>Senior Citizen System</h1>
  </div>

  <div class="main-div">

    <div class="left-div">
      <button class="left-button" style="border-top-left-radius: 15px; border-top-right-radius: 15px;"><img src="../admin/user_pics/<?= $emp_row['id_pic'] ?>" alt="" class="profile-pic">
        <p>Profile</p>
      </button>

      <button class="left-button" onclick=senior_function()>
        <span class="material-symbols-outlined">
          elderly
        </span>
        <p>Seniors</p>
      </button>

      <button class="left-button" onclick=request_function()>
        <span class="material-symbols-outlined">
          description
        </span>
        <p>Requests</p>
      </button>

      <button class="left-button" onclick=EventFunction()>
        <span class="material-symbols-outlined">
          event
        </span>
        <p>Events</p>
      </button>

      <button class="logout-button" onclick=logout_function()>
        <span class="material-symbols-outlined">
          logout
        </span>
        <p>Logout</p>
      </button>
    </div>
    
    <?php
      #select everything from the post table
      $sql_post = mysqli_query($conn, "SELECT * FROM post_tbl P LEFT JOIN emp_tbl E ON P.emp_id = E.emp_id LEFT JOIN admin_tbl A ON P.admin_id = A.admin_id INNER JOIN type_tbl T ON P.event_type_id = T.type_id ORDER BY date_created ASC, time_created DESC");
      $post_row = mysqli_num_rows($sql_post);
    ?>
    
    <div class="home-div">

      <div class="add-post" id="create-button">
        <div class="top-post">
          <img src="../admin/user_pics/<?= $emp_row['id_pic'] ?>" alt="" class="profile-pic" id="create-button">
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
            <form action="add_post.php" class="create-form" method="post" enctype="multipart/form-data">
              <textarea name="post-desc" id="post-desc" cols="30" rows="5" placeholder="Type the description of the event" class="post-desc"></textarea>
              <div class="create-divs">
                <label for="create-date" class="create-labels">Date of Event:</label>
                <input type="date" class="create-input"id="create-date" name="post-date">
              </div>

              <div class="create-divs">
                <label for="create-dime" class="create-labels">Time of Event:</label>
                <input type="time" class="create-input"id="create-time" value="0:00" placeholder="0:00" name="post-time">
              </div>

              <div class="create-divs">
                <label for="create-place" class="create-labels">Location of Event:</label>
                <input type="text" class="create-input"id="create-place" placeholder="Location" name="post-loc">
              </div>

              <div class="create-divs">
                <label for="create-place" class="create-labels">Type of Event:</label>
                <select name="event-type" id="create-select" class="create-input">
                  <option value="" hidden>Type of Event</option>
                  <option value="1">Recreational Event</option>
                  <option value="2">Claim Pension</option>
                  <option value="3">Health Related Event</option>
                  <option value="4">Announcement</option>
                </select>
              </div>

              <div class="create-divs">
                <label for="create-place" class="create-labels">Upload an image:</label>
                <input type="file" class="create-input"id="create-place" name="post-pics">
              </div>

              <div class="create-divs">
                <input type="submit" value="Post" id="submit-post">
              </div>
            </form>
          </div>
        </div> 


      </div>

      <?php
        #if the post table has more than 0 rows this will run
        if($post_row > 0) {
          while($row = mysqli_fetch_array($sql_post)){
            $post_id = $row['post_id'];
            #if the post is before the due date of the event this will run
            if(new DateTime() < new DateTime($row['post_date'] . $row['post_time'])){
      ?>
      <div class="post">
        <div class="title">
            <?php
            #this is to convert the created time and date into string so that we can change the format of the date and time
            $date_format = new DateTime($row['date_created']);
            $time_format = new DateTime($row['time_created']);

            #this is to convert the date of the event to string so that we can change the format of the date and time
            $event_time = new DateTime($row['post_time']);
            $event_date = new DateTime($row['post_date']);
              #if the admin is the one who created the post, this will display
              #you can tell if the employee posted when admin_id column is null
              if(is_null($row['admin_id'])){
            ?>
          <div class="post-profile">
            <img src="../admin/user_pics/<?php $row['id_pic'] ?>" alt="" class="profile-pic">
          </div>
          <div class="who-post">
            <div class="title-date">
              <h3 class="post-head"><?= $row['full_name'] ?></h3>
              <span class="material-symbols-outlined">
                more_horiz
              </span>
            </div>
            <div class="type-date">
              <p class="post-head"><?= $row['type_name'] . " . " . $row['post_date'] . " " . $row['post_time'] ?></p>
            </div>
          </div>
          <?php
              }
          #however if the emp was the one who created the post, this will display
          #you can tell if the admin posted when emp_id column is null
          elseif(is_null($row['emp_id'])){
          ?>
          <div class="who-post">
            <div class="title-date">
              <h3 class="post-head">Admin</h3>
              <span class="material-symbols-outlined">
                more_horiz
              </span>
            </div>
            <div class="type-date">
              <p class="post-head"><?= $row['type_name'] . " . Posted on: " . $date_format->format("m/d/Y") . " " .$time_format->format("h:ia")?> </p>
            </div>
          </div>
          <?php
          }
          ?>
        </div>

        <div class="post-details">
          <p>When: <?= $event_date->format("M/d/Y ") . "at " . $event_time->format("h:ia") ?></p>
          <p>Where: <?= $row['post_loc'] ?></p>
          <br>
          <p><?= $row['post_description'] ?></p>
        </div>

        <?php
          #if the posts contains the image, the image will be displayed
          if(!is_null($row['post_pic'])){

        ?>
        <div class="post-pic">
          <img src="posts/post_pics/<?= $row['post_pic'] ?>" alt="" class="da-pic">
        </div>
        <?php
            }
          #if the date passed the date of the event, the post will be removed and deleted from the table
        ?>
      </div>
      <?php
        }
        elseif(new DateTime() > new DateTime($row['post_date'] . $row['post_time'])){

          if(!is_null($row['post_pic'])){
            $original_post = "/posts/post_pics/" . $row['post_pic'];
            $deleted_post = "deleted/deleted_post_pics/" . $row['post_pic'];
            rename($original_post, $deleted_post);
          }
          
          $remove_sql = $conn->prepare("DELETE FROM post_tbl WHERE post_id=?");
          $remove_sql->bind_param("i", $post_id);
          $remove_sql->execute();
        }
      }
    }
        #if there are no rows this will be displayed
        elseif($post_row == 0) {

      ?>

      <div class="no-posts">
        <h1>There are no new posts</h1>
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
  else{
    header("Location: user_login.php");
  }

?>