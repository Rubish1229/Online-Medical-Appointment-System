<?php

require 'auth3.php';

require 'Connection.php';

$h_id = $_SESSION['h_id'];

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['addDept'])) {
    $dept = $_POST['newDepartment'];

    $sql = "INSERT INTO department (dept_name) VALUES (?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $dept);

    if ($stmt->execute()) {
        // echo "<script>alert('Department added successfully!');</script>";
    } else {
        // echo "<script>alert('Error adding department');</script>";
    }
}

$sql = "SELECT * FROM department";
$result = $con->query($sql);
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="hospital.css">
    <link rel="stylesheet" href="./css/utility.css">
</head>


<style>
    h3{
        margin-top: 30px;
    }

    .patientBookingListRight{
        margin-top: 60px;
    }
    .addDepartment{
        background-color: #d4e5ffff;
        padding: 10px 500px;
        height: 180px;
        border-radius: 5px;
        
        
    }
    .addDepartment button{
        margin-left: 40px;
        margin-top: 15px;
        margin-left: 70px;
    }
    .addDepartment input{
        height: 40px;
        min-width: 220px;
        border-radius: 5px;
        margin-top: 10px;
        border: 2px solid #0D6DFD;
        padding: 0px 10px;
    }
    h4{
        text-align: center;
    }
    .booking-table{
        margin-top: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
       
    }

   
   .h2{
    margin-left: 18px;
    font-weight: 500;
    padding-top: 20px;
   }
</style>
<body>

    <?php
    include 'navbar2.php';
    ?>

<div class="patientBookingList">

<div class="patientBookingListLeft">
        <ul>
            <li><a href="hpatientbooklist.php">Booking list</a></li>
        <li><a href="hospitalpatientlist.php">Patient signup list</a></li>
        <li><a href="hdoctorlist.php">Doctor signup list</a></li>
        <li><a href="hdepartment.php"style="color:orange;" >Department list</a></li>
        </ul>
    </div> 

        
  <div class="patientBookingListRight">
<h2 style="text-align: center; margin:10px;">Department</h2>
            <div class="addDepartment">
                <div class="h2">Add a new department</div>
          

                <form action="" method="POST">
                    <input type="text" name="newDepartment" placeholder="Add department" required>
                    <button type="submit" name="addDept" class="btn">ADD</button>
                </form>
            </div>

            <br>
            <br>
            <h4><u>List of department</u>   </h4>

            <form action="" method="GET">
            <div class="booking-table">
    <table style="border-collapse:collapse; width:800px;">
                    <tr>
                        <th>DepartmentID</th>
                        <th>DepartmaentName</th>
                        <th>Actions</th>

                    </tr>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['dept_id'] . "</td>";
                            echo "<td>" . $row['dept_name'] . "</td>";
                            echo "<td>
                                <div class='action-buttons'>
                    <a href='updatedepartment.php?dept_id=" . $row['dept_id'] . "' class='update'>UPDATE</a> | 
                    <a href='deldepartment.php?dept_id=" . $row['dept_id'] . "' class='delete'>DELETE</a>  
                            </div>
                    </td>";
                            echo "</tr>";
                        }
                    }

                    ?>

                </table>
</div>
            </form>


        </div>
    </div>

    <script src="reload.js"></script>
</body>

</html>