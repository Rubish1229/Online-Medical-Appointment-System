<?php
require 'Connection.php';

if(isset($_GET['dept_id'])){
    $dept_id = intval($_GET['dept_id']); // safer

    // Get department name
    $sql_dept = "SELECT dept_name FROM department WHERE dept_id = $dept_id";
    $res_dept = $con->query($sql_dept);
    $dept_name = ($res_dept->num_rows > 0) ? $res_dept->fetch_assoc()['dept_name'] : "Unknown Department";

    // Get doctors
    $sql = "SELECT d_name, d_contact 
            FROM sampledoctor 
            WHERE department_id = $dept_id";
    $result = $con->query($sql);
} else {
    die("Department not selected.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors</title>
    <link rel="stylesheet" href="./css/FindDoctors.css">
    <link rel="stylesheet" href="home.css">
</head>

<style>
    .div-container{
        display: flex;
        color: white;
        line-height: 29px;
    }
    .department-box p{
        font-style: italic;
    }

    .department-box{
        width: 300px;
    }
   
</style>
<body>
    <?php include'navbar1.php' ?>
    <h2>Doctors in <?php echo $dept_name; ?></h2>

    <div class="div-container">

    <?php
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo "<div class='department-box'>
                    <h3>".$row['d_name']."</h3>
                    <p>".$row['d_contact']."</p>
                  </div>";
        }
    } else {
        echo "<p>No doctors found in this department.</p>";
    }
    ?>

    </div>
</body>
</html>
