<?php
  include "../db_connect.php";


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Seniors</title>
    <script src="admin_script.js"></script>
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

      <button class="left-button" id="Active" onclick="view_senior()">
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

      <button class="left-button" onclick="scan_function()">
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
      <table class="senior-table">
        <thead class="table-head">
          <tr>
            <th></th>
            <th>Senior No.</th>
            <th>Status</th>
            <th>Name</th>
            <th>Birth Date</th>
            <th>Birth Place</th>
            <th>Age</th>
            <th>Sex</th>
            <th>Civil Status</th>
            <th>Citizenship</th>
            <th>Cellphone No.</th>
            <th>Purok</th>
            <th>Barangay</th>
            <th>Municipality</th>
            <th>Province</th>
          </tr>
        </thead>
        <tbody class="table-body">
          <?php
            #Select all of the data in the senior table
            $sql = mysqli_query($conn, "SELECT * FROM senior_tbl S RIGHT JOIN purok_tbl P ON S.purok_id = P.purok_id
            RIGHT JOIN barangay_tbl B ON S.barangay_id = B.barangay_id RIGHT JOIN municipality_tbl M ON S.municipality_id = M.municipality_id
            RIGHT JOIN province_tbl PR ON S.province_id = PR.province_id");

            while($row = mysqli_fetch_array($sql)){
              $birthday = $row['date_birth'];
              $birthday = new DateTime($birthday);
              $interval = $birthday->diff(new DateTime);
              $age = $interval->y;
          
          ?>
          <tr>
            <td><a href="view_senioracc.php?email=<?php echo $row['senior_email']; ?>&name=<?php echo $row['full_name'] ?>"><input type="button" value="View details" class="view-button"></a></td>
            <td><?=str_pad($row['senior_id'], 6, '0', STR_PAD_LEFT); ?></td>
            <td><?= $row['status'] ?></td>
            <td><?= $row['full_name'] ?></td>
            <td><?= $row['date_birth'] ?></td>
            <td><?= $row['birth_place'] ?></td>
            <td><?php echo $age; ?></td>
            <td><?= $row['sex'] ?></td>
            <td><?= $row['civil_status'] ?></td>
            <td><?= $row['citizenship'] ?></td>
            <td><?= str_pad($row['cell_no'], 13, '+63', STR_PAD_LEFT) ?></td>
            <td><?= $row['purok_no'] ?></td>
            <td><?= $row['barangay_name'] ?></td>
            <td><?= $row['municipality_name'] ?></td>
            <td><?= $row['province_name'] ?></td>
          </tr>
          <?php
            }
          ?>
        </tbody>
      </table>

    </div>

    <div class="right-div">

      <button class="right-div-buttons">

      </button>
      <button class="right-div-buttons">

      </button>
      <button class="right-div-buttons">

      </button>
      <button class="right-div-buttons">

      </button>

    </div>

  </div>
  

  </body>
</html>