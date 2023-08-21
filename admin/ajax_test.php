<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <link rel="stylesheet" href ="../layout.css?v=<?php echo time(); ?>">
  <title>Document</title>
</head>
<body>
  <div>
    <input type="text" id="search">
  </div>

  <div  class="mid-div">

  <table id="search-result" class="senior-table" id="senior-table">
    <thead class="table-head">
      <tr>
        <th>Senior No.</th>
        <th>Status</th>
        <th>Name</th>
        <th></th>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td>000001</td>
        <td>Active</td>
        <td>Carlson</td>
        <td></td>
      </tr>
    </tbody>
  </table>

  </div>
</body>

<script>
  $(document).ready(function(){

    $("#search").keyup(function(){
      var search = $(this).val();

      $.ajax({
        url:'text_jax.php',
        method:'post',
        data:{query:search},
        success:function(response){
          
          $("#search-result").html(response);

        }
      });
    });

  });
</script>
</html>