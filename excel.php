<?php
    include 'db_connect.php';
    date_default_timezone_set("Asia/Manila");
    $back_file = date("Y-m-d-H-i-s");
    $file_path = 'C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/' . $back_file . ".csv";
    $enclose_by = '"';
    $terminate_by = '\n';

    if(!file_exists($file_path)){
        $sql = mysqli_query($conn, "SELECT 'status', 'full_name', 'senior_id','first_name','mid_name','last_name','extension','date_birth','birth_place', 'sex','civil_status','citizenship','cell_no', 'age', 'senior_purok_id', 'senior_barangay_id','senior_municipality_id','senior_province_id','senior_email','senior_password','qr_image', 'id_pic', 'birth_certificate', 'account_time','account_date','qr_contents'
        UNION ALL
        SELECT * FROM senior_tbl INTO OUTFILE '$file_path' FIELDS TERMINATED BY ',' ENCLOSED BY '$enclose_by' LINES TERMINATED BY '$terminate_by'
        ");

    }

    else {
        $sql = mysqli_query($conn, "SELECT 'status', 'full_name', 'senior_id','first_name','mid_name','last_name','extension','date_birth','birth_place', 'sex','civil_status','citizenship','cell_no', 'age', 'senior_purok_id','senior_barangay_id','senior_municipality_id','senior_province_id','senior_email','senior_password','qr_image', 'id_pic', 'birth_certificate', 'account_time','account_date','qr_contents'
        UNION ALL
        SELECT * FROM senior_tbl INTO OUTFILE '$file_path' FIELDS TERMINATED BY ',' ENCLOSED BY '$enclose_by' LINES TERMINATED BY '$terminate_by'
        ");

    }

// Load the database configuration file 

 
// Fetch records from database 
$sql = mysqli_query($conn, "SELECT * FROM senior_tbl S RIGHT JOIN purok_tbl P
ON S.senior_purok_id = P.purok_id RIGHT JOIN barangay_tbl B 
ON S.senior_barangay_id = B.barangay_id RIGHT JOIN municipality_tbl M 
ON S.senior_municipality_id = M.municipality_id RIGHT JOIN province_tbl Pr 
ON S.senior_province_id = Pr.province_id");



if(mysqli_num_rows($sql) > 0) {
    $delimiter = ","; 
    $filename = "senior-data_" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('Senior_ID', 'FIRST NAME', 'MIDDLE NAME', 'LAST NAME', 'EXTENSION', 'PUROK', 'BARANGAY', 'MUNICAPLITY', 'PROVINCE', 'BIRTHDATE', 'AGE', 'SEX', 'CIVIL STATUS', 'CITIZENSHIP'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = mysqli_fetch_assoc($sql)){ 
        $birthday = $row['date_birth'];
        $birthday = new DateTime($birthday);
        $interval = $birthday->diff(new DateTime);
        $age = $interval->y;

        $lineData = array($row['senior_id'], $row['first_name'], $row['mid_name'], $row['last_name'], $row['extension'], $row['purok_no'], $row['barangay_name'], $row['municipality_name'], $row['province_name'], $row['date_birth'], $age, $row['sex'], $row['civil_status'], $row['citizenship']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f);
}
    exit;
 
?>

    

