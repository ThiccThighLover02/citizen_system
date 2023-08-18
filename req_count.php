<?php
    include "db_connect.php";

    $req = mysqli_query($conn, "SELECT * FROM request_tbl");
    $row_count = mysqli_num_rows($req);

?>