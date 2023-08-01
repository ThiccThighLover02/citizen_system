<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior Login Page</title>
    <link rel="stylesheet" href ="../style.css?v=<?php echo time(); ?>">
    
  </head>
  <body>
    <div class="topnav" id="myTopnav">
      <div class="dropdown-bruh">
        <div>
            <a href="../logout.php">Logout</a>
        </div>
      </div>
      <a href="#about">About</a>
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
    </div> 
  </body>

  <script>
    /* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
} 
  </script>
</html>