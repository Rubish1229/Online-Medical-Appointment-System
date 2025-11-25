<?php
session_start();
require 'Connection.php';

// Check if patient is logged in
if (!isset($_SESSION['p_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

$p_id = $_SESSION['p_id'];

// Fetch patient details
$sql = "SELECT * FROM patient WHERE p_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $p_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("No patient found.");
}

// Fetch all departments for dropdown
$sqlDept = "SELECT dept_id, dept_name FROM department";
$resultDept = $con->query($sqlDept);

// Step 1: Show doctors
$doctors = [];
if (isset($_POST['show_doctors'])) {
    $dept_id = $_POST['dept_id'];
    $stmtDoc = $con->prepare("SELECT d_id, d_name FROM sampledoctor WHERE department_id=?");
    $stmtDoc->bind_param("i", $dept_id);
    $stmtDoc->execute();
    $resultDoc = $stmtDoc->get_result();
    while ($doc = $resultDoc->fetch_assoc()) {
        $doctors[] = $doc;
    }
}

// Step 2: Book appointment
if (isset($_POST['book_appointment'])) {

    $doctor_id = $_POST['doctor_id'];
    $dept_id = $_POST['dept_id'];
    $appointment_date=$_POST['appointment_date'];
    $appointment_time=$_POST['appointment_time'];
   

    // Fetch department name
    $stmtDept = $con->prepare("SELECT dept_name FROM department WHERE dept_id=?");
    $stmtDept->bind_param("i", $dept_id);
    $stmtDept->execute();
    $dept_name = $stmtDept->get_result()->fetch_assoc()['dept_name'];

    // Insert into medicalcard
    $sqlInsert = "INSERT INTO medicalcard 
        (patient_id, patientName, patientGender, patientAge, patientContact, 
         patientAddress, doctor_id, departmentName,appointment_date,appointment_time)
         VALUES (?,?,?,?,?,?,?,?,?,?)";

    $stmtInsert = $con->prepare($sqlInsert);
    $stmtInsert->bind_param(
        "issississs",
        $row['p_id'],
        $row['p_name'],
        $row['p_gender'],
        $row['p_age'],
        $row['p_contact'],
        $row['p_address'],
        $doctor_id,
        $dept_name,
        $appointment_date,
        $appointment_time
       
    );

    if ($stmtInsert->execute()) {
        $success_msg = "Appointment booked successfully!";
    } else {
        $error_msg = "Error inserting: " . $stmtInsert->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Book Appointment</title>
<link rel="stylesheet" href="admin.css">
<link rel="stylesheet" href="hospital.css">
<link rel="stylesheet" href="pbook.css">
<link rel="stylesheet" href="./part/login.css">
</head>
<body>

<?php include 'navbar.php';?>


<div class="mainDiv">
    <div class="adminLeft pbookleft">
        <ul>
            <li><a href="#" style="color: orange;">Book appointments</a></li>
            <!-- <li><a href="#">Appointment queue</a></li> -->
            <li><a href="phistory.php">History</a></li>
        </ul>
    </div>

    <div class="adminRight" style="background-color: white;">
        <div class="pbookform">
            <div class="pbookformdiv2">
                <h4>Your Details:</h4>
                <div class="patientDetail">
                    <label>Full Name : <?php echo $row['p_name']; ?></label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <label>Patient ID : <?php echo $row['p_id']; ?></label><br><br>
                    <label>Gender : <?php echo $row['p_gender']; ?></label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <label>Age : <?php echo $row['p_age']; ?></label><br><br>
                    <label>Contact : <?php echo $row['p_contact']; ?></label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <label>Address : <?php echo $row['p_address']; ?></label><br><br>
                </div>

                <!-- Step 1: Select Department -->
                <form method="POST" action="pbook.php">
                    <label>Select Department:</label>
                    <select name="dept_id" required>
                        <option value="">Select Department</option>
                        <?php
                        if ($resultDept->num_rows > 0) {
                            while ($dept = $resultDept->fetch_assoc()) {
                                $selected = (isset($dept_id) && $dept_id == $dept['dept_id']) ? "selected" : "";
                                echo "<option value='{$dept['dept_id']}' $selected>{$dept['dept_name']}</option>";
                            }
                        }
                        ?>
                    </select>
                    <button type="submit" name="show_doctors">Confirm</button>
                </form>

                <br>

                <!-- Step 2: Show Doctors + Book Appointment -->
                <?php if (!empty($doctors)) : ?>
                    <form method="POST" action="pbook.php">
                        <label>Select Doctor:</label>
                        <select name="doctor_id" required>
                            
                            <?php
                            foreach ($doctors as $doc) {
                                echo "<option value='{$doc['d_id']}'>{$doc['d_name']}</option>";
                            }
                            ?>
                        </select>

                        <input type="hidden" name="dept_id" value="<?php echo $dept_id; ?>">

                        <br><br>
                       <label>Appointment Date:</label>
                        <input type="date" name="appointment_date" required>

                        <label>Appointment Time:</label>
                        <input type="time" name="appointment_time" required>
                        <br><br>
                        <button type="submit" name="book_appointment">Book Appointment</button>
                    </form>
                <?php endif; ?>

                <?php
                if (isset($success_msg)) {
                    echo "<p style='color:green;'>$success_msg</p>";
                } elseif (isset($error_msg)) {
                    echo "<p style='color:red;'>$error_msg</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>
