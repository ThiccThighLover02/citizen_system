<?php
    include "../db_connect.php";
    session_start();

    if(isset($_SESSION['emp_status']) && $_SESSION['emp_status'] == "Active"){

        $senior_id = $_GET['id'];

        $select_stmt = $conn->prepare("SELECT * FROM senior_tbl WHERE senior_id=?");
        $select_stmt->bind_param("i", $senior_id);
        $select_stmt->execute();
        $result = $select_stmt->get_result();
        $row = mysqli_fetch_assoc($result);


        #get the original location and the location where we're gonig to move the picture
        $get_pic = "../senior/senior_pics/id_pics/" . $row['id_pic'];
        $move_pic = "../admin/deleted/deleted_id_pics/" . $row['id_pic'];

        $get_birth = "../senior/senior_pics/birth_certificates/" . $row['birth_certificate'];
        $move_birth = "../admin/deleted/deleted_birth_certificates/" . $row['birth_certificate'];

        $get_qr = "../senior/senior_pics/qr_codes/" . $row['qr_image'];
        $move_qr = "../admin/deleted/deleted_qrcodes/" . $row['qr_image'];

        rename($get_pic, $move_pic);
        rename($get_birth, $move_birth);
        rename($get_qr, $move_qr);

        $delete = $conn->prepare("DELETE FROM senior_tbl WHERE senior_id=?");
        $delete->bind_param("i", $senior_id);
        $delete->execute();

        header("Location: user_view_senior.php");

        
    }

    else{
        header("Location: user_login.php");
    }


?>