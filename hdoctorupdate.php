<?php
require 'Connection.php';


if (!isset($_GET['d_id']) || empty($_GET['d_id'])) {
    die("Error: Patient ID missing in URL.");
}

$id = $_GET['d_id'];


$sql = "SELECT * FROM doctor WHERE d_id = $id";
$result = $con->query($sql);

if ($result->num_rows == 0) {
    die("Error: No doctor found with this ID.");
}

$doctor = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = $_POST['d_name'];
    $email = $_POST['d_email'];
    $pwd = $_POST['d_pwd'];
    $department = $_POST['d_department'];
    $licensenum = $_POST['d_licensenum'];
    $contact = $_POST['d_contact'];
    $address = $_POST['d_address'];
    $gender = $_POST['d_gender'];

    $update = "UPDATE doctor SET
                d_name='$name',
                d_email='$email',
                d_pwd='$pwd',
                d_pwd='$department',
                d_pwd='$licensenum',
                d_contact='$contact',
                d_address='$address',
                d_gender='$gender'
                WHERE d_id=$id";

    if ($con->query($update)) {
       
        header("Location:h  doctorlist.php ");
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

            <label>Name:</label><br>
            <input type="text" name="d_name" value="<?php echo $doctor['d_name']; ?>"><br><br>

            <label>Email:</label><br>
            <input type="email" name="d_email" value="<?php echo $doctor['d_email']; ?>"><br><br>

            <label>Password:</label><br>
            <input type="text" name="d_pwd" value="<?php echo $doctor['d_pwd']; ?>"><br><br>

             <label>Department:</label><br>
            <input type="text" name="d_department" value="<?php echo $doctor['d_department']; ?>"><br><br>

             <label>Password:</label><br>
            <input type="number" name="d_licensenum" value="<?php echo $doctor['d_licensenum']; ?>"><br><br>

            <label>Contact:</label><br>
            <input type="text" name="d_contact" value="<?php echo $doctor['d_contact']; ?>"><br><br>

            <label>Address:</label><br>
            <input type="text" name="d_address" value="<?php echo $doctor['d_address']; ?>"><br><br>

            <label>Gender:</label><br>
            <select name="d_gender">
                <option value="Male" <?php if ($doctor['d_gender'] == "Male") echo "selected"; ?>>Male</option>
                <option value="Female" <?php if ($doctor['d_gender'] == "Female") echo "selected"; ?>>Female</option>
                <option value="Other" <?php if ($doctor['d_gender'] == "Other") echo "selected"; ?>>Other</option>
            </select>
            <br><br>

            <button type="submit" class="updateBtn">Update Patient</button>
        </form>

    </div>
</div>

</body>
</html>
