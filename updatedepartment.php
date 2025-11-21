<?php

require 'Connection.php';


if (!isset($_GET['dept_id']) || empty($_GET['dept_id'])) {
    die("Error : departmentId is missing");
}

$id = $_GET['dept_id'];

$sql = "SELECT * FROM department WHERE dept_id=$id";
$result = $con->query($sql);

if ($result->num_rows == 0) {
    die("No department found with this id");
}

$department = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $deptid = $_POST['dept_id'];
    $deptname = $_POST['dept_name'];

    $update = "UPDATE department SET
    dept_name='$deptname' WHERE dept_id=$id";

    if ($con->query($update)) {
        header("Location:hdepartment.php");
    } else {
        echo "Update error: " . $con->error;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Doctor</title>
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
                <li><a href="">Appointments</a></li>
                <li><a href="">Departments</a></li>
                <li><a href="">Doctors</a></li>
                <li><a href="">Patients</a></li>
            </ul>
        </div>

        <div class="adminRight">
            <h2>Update Doctor Information</h2>

            <form action="" method="POST" class="formStyle">

                <input type="hidden" name="dept_id" value="<?php echo $department['dept_id']; ?>">

                <label>Name:</label><br>
                <input type="text" name="dept_name" value="<?php echo $department['dept_name']; ?>"><br><br>



                <button type="submit" class="updateBtn">Update </button>
            </form>

        </div>
    </div>

</body>

</html>