<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="id.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <?php 

            include 'db_connect.php';
            if(isset($_GET['id'])){
            $id = $_GET['id'];
            $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P
            ON S.senior_purok_id = P.purok_id INNER JOIN barangay_tbl B 
            ON S.senior_barangay_id = B.barangay_id INNER JOIN municipality_tbl M 
            ON S.senior_municipality_id = M.municipality_id INNER JOIN province_tbl Pr 
            ON S.senior_province_id = Pr.province_id WHERE senior_id=?");
            
            $sql->bind_param("i", $id);
            $sql->execute();
            $result = $sql->get_result();

            $row = mysqli_fetch_assoc($result);
            

            $birthday = new DateTime($row['date_birth']);
            $interval = $birthday->diff(new DateTime);
            $age = $interval->y;
        ?>

<div class="id-layout">
            <div class="top-div">
                <img src="munisipyo.png" alt="" class="logo">
                <div class="header">
                    <p class="republic">Republic of the Philippines</p>
                    <b><p class="office">OFFICE OF THE SENIOR CITIZENS AFFAIRS</p></b>
                    <p class="municipality">San Isidro, Nueva Ecija</p>
                </div>
            </div>


            <div class="id-contents">
                <label for="" class="senior-no"><?=str_pad($row['senior_id'], 6, '0', STR_PAD_LEFT)?></label>
                <div class="name">
                    <p><?=$row['full_name'] . " " . $row['extension'] ?></p>
                    <hr class="line">
                    <p>Name</p>
                </div>

                <div class="address">
                    <p><?=$row['purok_no'] . ", " . $row['barangay_name'] . ", " . $row['municipality_name'] . ", " . $row['province_name'] ?></p>
                    <hr class="line">
                    <p>Address</p>
                </div>
                
                <div class="pic">
                    <img src="senior/senior_pics/id_pics/<?=$row['id_pic'] ?>" class="id-pic">
                </div>

                <div class="date-birth">
                    <p><?= $row['date_birth'] ?></p>
                    <hr class="line">
                    <p>Birthdate</p>
                </div>

                <div class="age">
                    <p><?php echo $age; ?></p>
                    <hr class="line">
                    <p>Age</p>
                </div>

                <div class="id-no">
                    <p><?= str_pad($row['senior_id'], 6, '0', STR_PAD_LEFT) ?></p>
                    <hr class="line">
                    <p>Id Number</p>
                </div>

                <div class="date-issue">
                    <p><?php echo date("Y-m-d"); ?></p>
                    <hr class="line">
                    <p>Date Issued</p>
                </div>

            </div>
                
            
        </div>

        <div class="qr">
            <div class="how-to">
                instructions goes here
            </div>
            <img src="senior/senior_pics/qr_codes/<?= $row['qr_image']?>" alt="" class="qr-pic">
            
        </div>

        <div class="instructions-eng">

        </div>

        <div class="instructions-tag">

        </div>
        <?php

            }

            
        ?>
        

    </div>
        
</body>
</html>