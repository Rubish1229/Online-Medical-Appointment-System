<?php
require 'Connection.php';

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['addDept'])) {
    $dept = $_POST['newDepartment'];

    $sql = "INSERT INTO department (dept_name) VALUES (?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $dept);

    if ($stmt->execute()) {
        echo "<script>alert('Department added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding department');</script>";
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
</head>

<body>

    <?php
    include 'navbar.php';
    ?>


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

            <form action="" method="GET">
                <table border="1" cellpadding="6" class="tb">
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
                    <a href='updatedepartment.php?dept_id=" . $row['dept_id'] . "' class='update'>UPDATE</a> | 
                    <a href='deldepartment.php?dept_id=" . $row['dept_id'] . "' class='delete'>DELETE</a>  
                </td>";
                            echo "</tr>";
                        }
                    }

                    ?>

                </table>
            </form>


        </div>
    </div>

</body>

</html>