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

      <button class="left-button" onclick=request_function() id="Active">
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
      $sql = mysqli_query($conn, "SELECT * FROM request_tbl ORDER BY request_date DESC, request_time ASC");

    ?>

    <div class="mid-div-only">
      <div class="request-header">
        <h1>Requests</h1>
      </div>
      <?php
      while($row = mysqli_fetch_array($sql)){

        $date_format = new DateTime($row['request_date'] . $row['request_time']);

      ?>
      <div class="in-mid">
        <div>
          <a href="user_view_requests.php?request_id=<?php echo $row['request_id']; ?>"><input type="button" value="View Request" class="view-button"></a>
        </div>
        <div>
          <h3 class="request-head"><?php echo $row['first_name'] . " " . $row['last_name'] . " is requesting for an account" ?></h3>
        </div>
        <div>
          <h3 class="request-head"><?= $date_format->format("M-d-Y / h:ia") ?></h3>
        </div>
      </div>

      <?php
      }
      ?>

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