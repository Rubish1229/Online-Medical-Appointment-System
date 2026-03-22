
<?php
 require 'Connection.php';

 $sql ="SELECT d_name,dept_name,d_contact FROM sampledoctor
        JOIN department
        ON department_id=dept_id";

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
    width: 250px;
    
  }
  .department-box:hover{
      font-size: 17px;
  }

  .department-box ul li{
    list-style: none;
    color: white;
    margin-top: 10px;
    text-align: center;
  }

  .department-box li:first-child {
    text-decoration: underline;
}

.department-box li:last-child {
    font-style: italic;
}

.department-box h3{
  color: white;
}

  
    
</style>
<body>


    <?php include 'navbarSignup.php' ?>
  
    <h2>DOCTORS</h2>
  <div class="div-container">
  <?php  
    if($result->num_rows>0){
      while($row=$result->fetch_assoc()){
          echo "<div class='department-box'><h3>".$row['d_name']."</h3>
            <ul>
              <li>".$row['dept_name']."</li>
              <li>".$row['d_contact']."</li>
            
            </ul>
          </div>";
      } 
    }else echo "<div> No doctors found !";
  ?>
  

  </div>
  </div>

</body>
</html>