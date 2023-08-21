<?php
  include ('db_connect.php');

  if(isset($_POST['input'])){ #if the search bar is set this code will run

    $input = $_POST['input'];
    $id_input = str_pad($input, 5, '0', STR_PAD_LEFT);

    $senior_tbl = mysqli_query($conn, "SELECT * FROM senior_tbl");

    $sql = mysqli_query($conn, "SELECT * FROM senior_tbl WHERE full_name LIKE '{$input}%' OR first_name LIKE '{$input}%' OR mid_name LIKE '{$input}%'
    OR last_name LIKE '{$input}%'
    OR LPAD(senior_id, 6, 0) LIKE '{$id_input}%'"); #this query will select all from the senior_tbl that has been typed in the search bar

    if (mysqli_num_rows($sql) > 0) {
?>
                <thead class="table-head">
                    <tr>
                        <th>Senior No.</th>
                        <th>Status</th>
                        <th>Name</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody class="table-body">
                    <?php
                        while ($row = mysqli_fetch_assoc($sql)) {

                        ?>
                        <tr>
                            <td><?=str_pad($row['senior_id'], 6, '0', STR_PAD_LEFT); ?></td>
                            <td class="stats"><div class="<?= $row['status'] ?>"></div><?= $row['status'] ?> </td>
                            <td><?= $row['full_name'] ?></td>
                            <td><a href="admin_senior_acc.php?id=<?= $row['senior_id'] ?>"><input type="button" value="View details" class="view-button"></a></td>
                        </tr>
                        <?php 
                        }

                        ?>
                    

                   
                </tbody>
    <?php
    }

                        ?>
                    
<?php
    }   

?>