<?php
require 'Connection.php';

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['addDept'])) {
    $dept = $_POST['newDepartment'];

    $sql = "INSERT INTO department (dept_name) VALUES (?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $dept);

    if($stmt->execute()) {
        echo "<script>alert('Department added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding department');</script>";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="hospital.css">
</head>
<body>

<nav>
        <img src="images/SWASTHYA.png" alt="logo">
    </nav>

    
    <div class="mainDiv">
        <div class="adminLeft hospitalleft">
            <ul>
                <li> <a href="">Appoinments</a></li>
                <li> <a href="" style="color: green;">Departments</a></li>
                <li> <a href="">Doctors</a></li>
                <li> <a href="">Patients</a></li>
               
            </ul>
</div>
        <div class="adminRight">
            <div class="addDepartment">
                <div class="h2">Add a new department</div>

               
            <form action="" method="POST">
                <input type="text" name="newDepartment" placeholder="new department" required>
                <button type="submit" name="addDept">ADD</button>
            </form>
            </div>


        <h4>List of department</h4>

         <table border="1" cellpadding="6" class="tb">
        <tr>
            <th>HospitalID</th>
            <th>HospitalName</th>
            <th>HospitalEmail</th>
            <th>HospitalContact</th>
            <th>HospitalAddress</th>
            <th>HospitalLicenseNum</th>
            <th>Signup date/time</th>
            <th>Actions</th>
        </tr>
        <?php
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc()){
                echo "<tr>";
                echo "<td>".$row['h_id']."</td>";
                echo "<td>".$row['h_name']."</td>";
                echo "<td>".$row['h_email']."</td>";
                echo "<td>".$row['h_contact']."</td>";
                echo "<td>".$row['h_address']."</td>";  
                echo "<td>".$row['h_licensenum']."</td>";  
                echo "<td>".$row['h_createddate']."</td>";  

                echo"<td>
                    <a href='update.php?id=".$row['h_id']."'class='update'>UPDATE</a> | 
                    <a href='delete.php?h_id=".$row['h_id']."'class='delete'>DELETE</a>  
                </td>";
                echo "</tr>";
            }
        }

        ?>

    </table>

        
        </div>
    </div>
    
</body>
</html>