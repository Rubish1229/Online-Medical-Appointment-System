<?php
require 'Connection.php';

// 1️⃣ Check if ID is coming
if (!isset($_GET['p_id']) || empty($_GET['p_id'])) {
    die("Error: Patient ID missing in URL.");
}

$id = $_GET['p_id'];

// 2️⃣ Get old data of this patient
$sql = "SELECT * FROM patient WHERE p_id = $id";
$result = $con->query($sql);

if ($result->num_rows == 0) {
    die("Error: No patient found with this ID.");
}

$patient = $result->fetch_assoc();

// 3️⃣ If form submitted → update DB
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = $_POST['p_name'];
    $email = $_POST['p_email'];
    $pwd = $_POST['p_pwd'];
    $contact = $_POST['p_contact'];
    $address = $_POST['p_address'];
    $gender = $_POST['p_gender'];

    $update = "UPDATE patient SET
                p_name='$name',
                p_email='$email',
                p_pwd='$pwd',
                p_contact='$contact',
                p_address='$address',
                p_gender='$gender'
                WHERE p_id=$id";

    if ($con->query($update)) {
       
        header("Location:hospitalpatientlist.php ");
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
    <title>Update Patient</title>
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
        <h2>Update Patient Information</h2>

        <form action="" method="POST" class="formStyle">

            <label>Name:</label><br>
            <input type="text" name="p_name" value="<?php echo $patient['p_name']; ?>"><br><br>

            <label>Email:</label><br>
            <input type="email" name="p_email" value="<?php echo $patient['p_email']; ?>"><br><br>

            <label>Password:</label><br>
            <input type="text" name="p_pwd" value="<?php echo $patient['p_pwd']; ?>"><br><br>

            <label>Contact:</label><br>
            <input type="text" name="p_contact" value="<?php echo $patient['p_contact']; ?>"><br><br>

            <label>Address:</label><br>
            <input type="text" name="p_address" value="<?php echo $patient['p_address']; ?>"><br><br>

            <label>Gender:</label><br>
            <select name="p_gender">
                <option value="Male" <?php if ($patient['p_gender'] == "Male") echo "selected"; ?>>Male</option>
                <option value="Female" <?php if ($patient['p_gender'] == "Female") echo "selected"; ?>>Female</option>
                <option value="Other" <?php if ($patient['p_gender'] == "Other") echo "selected"; ?>>Other</option>
            </select>
            <br><br>

            <button type="submit" class="updateBtn">Update Patient</button>
        </form>

    </div>
</div>

</body>
</html>
