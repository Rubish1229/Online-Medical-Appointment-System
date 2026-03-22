
<?php
 require 'Connection.php';

 $sql ="SELECT dept_id,dept_name FROM department";

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
    
</style>
<body>


    <?php include 'navbarSignup.php' ?>
  
    <h2>DEPARTMENTS</h2>
  <div class="div-container">
  <?php  
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<div class='department-box'>
                <h3>
                  <a href='doctors.php?dept_id=".$row['dept_id']."'>
                    ".$row['dept_name']."
                  </a>
                </h3>
              </div>";
    } 
}else{
    echo "<div>No departments found!</div>";
}
?>

  

  </div>
  </div>

</body>
</html>