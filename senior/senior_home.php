<?php
session_start();
include "../db_connect.php";


if(isset($_SESSION['senior_id']) && $_SESSION['senior_status'] == "Active") {

  $sql = $conn->prepare("SELECT id_pic FROM senior_tbl WHERE senior_id=?");
  $sql->bind_param("s", $_SESSION['senior_id']);
  $sql->execute();
  $result = $sql->get_result();
  $row = mysqli_fetch_assoc($result);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior Home Page</title>
    <script src="senior_script.js"></script>
    <link rel="stylesheet" href ="../layout.css?v=<?php echo time(); ?>">
    
  </head>
  <body class="background">
  <div class="top-nav">
    <h1>Senior Citizen System</h1>
  </div>

  <div class="main-div">

    <div class="left-div">
      <button class="left-button" style="border-top-left-radius: 15px; border-top-right-radius: 15px;"><img src="senior_pics/id_pics/<?= $row['id_pic'] ?>" alt="" class="profile-pic">
        <p>Profile</p>
      </button>

      <button class="left-button">
        <span class="material-symbols-outlined">
          person
        </span>
        <p>Users</p>
      </button>

      <button class="left-button">
        <span class="material-symbols-outlined">
          elderly
        </span>
        <p>Seniors</p>
      </button>

      <button class="left-button">
        <span class="material-symbols-outlined">
          description
        </span>
        <p>Requests</p>
      </button>

      <button class="left-button">
        <span class="material-symbols-outlined">
          qr_code
        </span>
        <p>Scan QR code</p>
      </button>

      <button class="logout-button" onclick="logout_function()">
        <span class="material-symbols-outlined">
          logout
        </span>
        <p>Logout</p>
      </button>
    </div>
    
    <div class="mid-div">

      <h1>this is the mid div</h1>

    </div>

    <div class="right-div">

      <h1>this is the right div</h1>

    </div>

  </div>
  

  </body>
</html>

<?php
}
else {
  header("Location: senior_login.php");
}
?>