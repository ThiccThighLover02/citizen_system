<?php
  include "../db_connect.php";
  include "../req_count.php";
  date_default_timezone_set('Asia/Manila');


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Seniors</title>
    <script src="admin_script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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

    <!-- this is the mid div -->

    <div class="mid-div-only" id="orig-sen-tbl">
    <?php
      include "calendar.php";
    ?>
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