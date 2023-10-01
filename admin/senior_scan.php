<?php
    include '../db_connect.php';
    

    if(isset($_GET['scan']) && isset($_GET['act_id'])){
        $qr_content = $_GET['scan'];

        $sql = $conn->prepare("SELECT * FROM senior_tbl WHERE qr_contents=?");
        $sql->bind_param("s", $qr_content);
        $sql->execute();
        $result = $sql->get_result();
        $num_row = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result);
        $currentDate = date("Y-m-d");
        $currentTime = date("H:i:s");

        $attend = $conn->prepare("SELECT senior_attend FROM attend_tbl WHERE senior_attend=? AND activity_id=?");
        $attend->bind_param("ii", $row['senior_id'], $_GET['act_id']);
        $attend->execute();
        $att_result = $attend->get_result();
        $att_rows = mysqli_num_rows($att_result);

        if($att_rows <= 0){
            if($num_row > 0){
                $insert = $conn->prepare("INSERT INTO `senior_system`.`attend_tbl` (`activity_id`, `senior_attend`, `senior_barangay`, `attend_date`, `attend_time`) VALUES (?, ?, ?, ?, ?);");
                $insert->bind_param("iiiss", $_GET['act_id'], $row['senior_id'], $row['senior_barangay_id'], $currentDate, $currentTime);
                $insert->execute();
    
            header("Location: admin_view_activities.php?scan=success&event=" . $_GET['act_id']);
            }
            elseif($num_row <= 0){
                header("Location: admin_view_activities.php?scan=fail&event=" . $_GET['act_id']);
            }
        }

        elseif($att_rows > 0){
            header("Location: admin_view_activities.php?scan=fail&event=" . $_GET['act_id']);
        }
    }


?>