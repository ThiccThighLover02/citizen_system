<?php
  include "../db_connect.php";
  include "../req_count.php";


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Seniors</title>
    <script src="admin_script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href ="../layout.css?v=<?php echo time(); ?>">
    
  </head>
  <body class="background">
  <div class="top-nav">
    <h1>Senior Citizen System</h1>
  </div>

  <div class="main-div">

    <!-- left div goes here -->

    <?php
    $active = "actActivity";
    include_once "admin_left_div.php";
    ?>

    <div class="mid-div-activities" id="orig-sen-tbl">
    <?php
        $sql = mysqli_query($conn, "SELECT * FROM activity_tbl A INNER JOIN type_tbl T ON A.event_type_id = T.type_id");
        $num_rows = mysqli_num_rows($sql);
        
        if($num_rows > 0){
            while($row = mysqli_fetch_array($sql)){
                $date_format = new DateTime($row['post_date']);
                $currentDateTime = new DateTime('now');
                $currentDate = $currentDateTime->format("Y-m-d");
                $currentTime = $currentDateTime->format("H:i:s");
                if($currentDate . $currentTime < new DateTime($row['post_date'] . $row['post_time'])){
    ?>

    <div class="mid-cards">
        <img src="../user/posts/post_pics/<?= $row['post_pic'] ?>" alt="Avatar" class="card-img">
        <div class="card-container">
            <h4><b><?= $row['type_name'] ?></b></h4>
            <?php
            if($currentDate == new DateTime($row['post_date'])){
            ?>
            <p>Ongoing</p>
            <?php
            }
            else{
            ?>
            <p>Event on <?= $row['post_date'] ?></p>

            <a href="admin_view_activity.php?event=<?= $row['post_id'] ?>"><button>View Activity</button></a>
        </div>
    </div>

    <?php
            }
            }
        }
    }
    ?>

    

    </div>
     

    <div class="right-div">

    <div class="right-search">

    </div>

  </div>
  

  </body>

  <script>
  $(document).ready(function(){

    $("#search").keyup(function(){
      var search = $(this).val();

      $.ajax({
        url:'../senior_jax.php',
        method:'post',
        data:{query:search},
        success:function(response){
          
          $("#search-result").html(response);

        }
      });
    });

  });
</script>

</html>