
<?php
 require 'Connection.php';

 $sql ="SELECT h_name FROM hospital";

 $result=$con->query($sql);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/FindDoctors.css">
    <link rel="stylesheet" href="home.css">
  
 

</head>
<style>

  .department-box{
    width: 300px;
  }
    .department-box h3{
      color: white;
    }
</style>
<body>


    <?php include 'navbarSignup.php' ?>
  
    <h2>HOSPITALS</h2>
  <div class="div-container">
  <?php  
    if($result->num_rows>0){
      while($row=$result->fetch_assoc()){
          echo "<div class='department-box'><h3>".$row['h_name']." Hospital"."</h3></div>";
      } 
    }else echo "<div> No departments found !";
  ?>
  

  </div>
  </div>

</body>
</html>