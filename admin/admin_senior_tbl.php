<?php  
    include("../db_connect.php");
?>

<table class="senior-table">
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

        while($row = mysqli_fetch_array($sql)){
            $birthday = $row['date_birth'];
            $birthday = new DateTime($birthday);
            $interval = $birthday->diff(new DateTime);
            $age = $interval->y;
        
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
</table>
