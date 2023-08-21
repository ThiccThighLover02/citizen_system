<?php
    session_start();
    date_default_timezone_set("Asia/Manila");

    include "db_connect.php";

    function admin_or_emp(){

        if(isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == "Active"){
            header("Location: admin/admin_home.php");
        }

        elseif(isset($_SESSION['emp_status']) && $_SESSION['emp_status'] == "Active") {
            header("Location: user/user_home.php");
        }

    }

    if(isset($_SESSION['admin_status']) || isset($_SESSION['emp_status'])){
        if($_SESSION['admin_status'] == "Active" || $_SESSION['emp_status'] == "Active"){
            
            $post_desc = $_POST['post-desc'];
            $post_date = $_POST['post-date'];
            $post_time = $_POST['post-time'];
            /*
            $post_loc = $_POST['post-loc'];
            $post_pic = $_POST['post-pic'];
            */
            $post_type = "Claim Pension";
            $date_created = date("Y-m-d");
            $time_created = date("H:i:s");


            #this is for the with_id pic

            $post_name = $_FILES['post-pics']['name'];
            $post_size = $_FILES['post-pics']['size'];
            $post_tmp_name = $_FILES['post-pics']['tmp_name'];
            $post_error = $_FILES['post-pics']['error'];

            if($post_error === 0){
                 if ($post_size > 16777215){
                 header("Location: create_acc.php?img_size=false"); #this will execute if the file ist too large
                 }
             
                 else {
                     $img_ex = pathinfo($post_name, PATHINFO_EXTENSION);
                     $img_ex_lc = strtolower($img_ex);

                     $allowed_exs = array("jpg", "jpeg", "png");

                     if(in_array($img_ex_lc, $allowed_exs)) {
                       date_default_timezone_set("Asia/Manila");
                       $new_post_name ="post" . date("Y") . random_int(1000, 9999) . "." . $img_ex_lc;
                       $img_upload_path = 'user/posts/post_pics/' . $new_post_name;
                       move_uploaded_file($post_tmp_name, $img_upload_path); 
                     }
                 }
             }

             if(isset($_SESSION['admin_status'])){
                $post_stmt = $conn->prepare("INSERT INTO `senior_system`.`post_tbl` (`admin_id`, `post_type`, `post_description`, `post_pic`, `post_date`, `post_time`, `date_created`, `time_created`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $post_stmt->bind_param("isssssss", $_SESSION['admin_id'], $post_type, $post_desc, $new_post_name, $post_date, $post_time, $date_created, $time_created);
                $post_stmt->execute();
                admin_or_emp();

             }

             elseif(isset($_SESSION['emp_status'])){
                $post_stmt = $conn->prepare("INSERT INTO `senior_system`.`post_tbl` (`emp_id`, `post_type`, `post_description`, `post_pic`, `post_date`, `post_time`, `date_created`, `time_created`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $post_stmt->bind_param("isssssss", $_SESSION['emp_id'], $post_type, $post_desc, $new_post_name, $post_date, $post_time, $date_created, $time_created);
                $post_stmt->execute();
                admin_or_emp();

             }

}

else{
    header("Location: index.php");
}
}


?>