<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior Home Page</title>
    <script src="admin_script.js"></script>
    <script src="../node_modules//html5-qrcode/html5-qrcode.min.js"></script> <!-- call the script that we will use to scan the qr code -->
    <link rel="stylesheet" href ="../layout.css?v=<?php echo time(); ?>">
    
  </head>
  <body class="background">
  <div class="top-nav">
    <h1>Senior Citizen System</h1>
  </div>

  <div class="main-div">

    <div class="left-div">
    <button class="left-button" style="border-top-left-radius: 15px; border-top-right-radius: 15px;"><img src="id_pics/2x2 pic.jpg" alt="" class="profile-pic">
        <p>Profile</p>
      </button>

      <button class="left-button" onclick="home_function()">
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
      </button>

      <button class="left-button" id="Active" onclick="scan_function()">
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
    
    <div class="mid-div-only" id="mid-scan-div">

      <div id="reader"></div>
      <div id="result"></div>

    </div>
  

  </body>

  <script>


    const scanner = new Html5QrcodeScanner('reader', {
    qrbox: {
      width:500,
      height: 100,
    },
    fps:20, 
    });

    scanner.render(success, error);

    function success(result) {
        scanner.clear();
        var scan_result = result;
        console.log(scan_result);
        window.location.href="view_senioracc.php?" + result;
    }


    function error(err){
      console.error(err);
    }
  </script>
</html>