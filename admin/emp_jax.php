<?php

    session_start();
  include ('../db_connect.php');

    if(isset($_POST['query'])){ 
        #if the search bar is set this code will run
        $search = $_POST['query'];
        $emp_id = str_pad($search, 5, '0', STR_PAD_LEFT);
        $stmt = $conn->prepare("SELECT * FROM emp_tbl WHERE first_name LIKE CONCAT('%', ?, '%') OR middle_name LIKE CONCAT('%', ?, '%') OR last_name LIKE CONCAT('%', ?, '%') OR full_name LIKE CONCAT('%', ?, '%') OR emp_id LIKE CONCAT('%', ?, '%')");
        $stmt->bind_param("sssss", $search, $search, $search, $search, $senior_id);
      }
    
      else{
        $stmt=$conn->prepare("SELECT * FROM emp_tbl");
      }
    
      $stmt->execute();
      $result=$stmt->get_result();
    
      if($result->num_rows > 0) {
    
        $output = '<thead class="table-head">
        <tr>
            <th>Emp No..</th>
            <th>Status</th>
            <th>Name</th>
            <th></th>
        </tr>
        </thead>
        <tbody class="table-body">';
    
        while($row = $result->fetch_assoc()){
            $output .=
            "<tr>
            <td>" . str_pad($row['emp_id'], 6, '0', STR_PAD_LEFT) . "</td>" .
            '<td class="stats"><div class="' . $row['status'] . '"></div>' . $row['status'] . "</td>
            <td>" . $row['full_name'] . '</td>
            <td><a href="emp_senior_acc.php?id=' . $row['emp_id'] . '"><input type="button" value="View details" class="view-button"></a></td>
            </tr>';
        }
    
        $output .= "</tbody>";
        echo $output;
      }
      else{
        echo "<h1> There are no employees </h1>";
      }

  
?>