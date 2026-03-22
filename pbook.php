<?php
session_start();

require 'auth.php';


require 'Connection.php';




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


    $checkSql = "SELECT * FROM medicalcard 
             WHERE doctor_id = ? 
             AND departmentName = ?
             AND appointment_date = ?
             AND appointment_time = ?";

$stmtCheck = $con->prepare($checkSql);
$stmtCheck->bind_param("isss", 
    $doctor_id,
    $dept_name,
    $appointment_date,
    $appointment_time
);

$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();

if ($resultCheck->num_rows > 0) {

    
    $error_msg = "This time slot is already booked. Please choose another time.";

} else {

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
        $success_msg = " <span class='notifynew'><h3><b>Appointment booked successfully !</b></h3></span>";
    } else {
        $error_msg = "Error inserting: " . $stmtInsert->error;
    }
}

if ($stmtInsert->execute()) {

    // Insert into appointments table
    $stmtApp = $con->prepare("INSERT INTO appointments 
        (doctor_id, patient_id, app_date, app_time) 
        VALUES (?, ?, ?, ?)");

    $stmtApp->bind_param(
        "iiss",
        $doctor_id,
        $row['p_id'],
        $appointment_date,
        $appointment_time
    );

    $stmtApp->execute();

    $success_msg = "<span class='notifynew'><h3><b>Appointment booked successfully !</b></h3></span>";
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
<link rel="stylesheet" href="./css/utility.css">
</head>

<style>
    .pbookform{
        background-color: #ffffff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.8);
    }
 .notify {
    padding: 5px 25px;
    margin: 20px auto;
    width: fit-content;
    border-radius: 8px;
    text-align: center;
    font-family: Arial, sans-serif;
    box-shadow: 10px 4px 10px #0D6DFD;
    font-size: 18px;
    z-index: 10;
}

.notify.success {
    background-color: #e6ffed;
    border: 2px solid #28a745;
}

.notify.success h2 {
    color: #198754;
}

.notify.error {
    background-color: #ffe6e6;
    border: 2px solid #dc3545;
}

.notify.error h2 {
    color: #842029;
}
.rightside{
    margin-left: 150px;
}
.btn{
    margin-left: 70px;

}
.leftside{
    margin-left: 100px;
}
h2{
    text-align: center;
      text-shadow: 2px 2px 5px rgba(13, 109, 253, 0.3); 
      color: #0D6DFD;
}

.line{
    margin-left: 5rem;

}

.form{
    margin: 30px 100px;
}

label{
    font-weight: 500;
    margin-right: 5px;
}
.btn{
    margin-left: 50px;
}

.btn2{
    margin:40px 230px;
}
</style>
<body>
<?php
include 'navbar2.php';
?>


<div class="mainDiv">
    <div class="adminLeft pbookleft">
        <ul>
            <li><a href="pbook.php" style="color: orange;">Book appointment</a></li>
            <!-- <li><a href="#">Appointment queue</a></li> -->
            <li><a href="imageDisplay.php">History</a></li>
        </ul>
    </div>

    <div class="adminRight" style="background-color: white;">
        <div class="pbookform" style="box-shadow: 0px 15px 25px rgba(13, 109, 253, 0.6); height:35rem;">
            <div class="pbookformdiv2">
                <h2>Appointment card</h2>
                <div class="detailsbox">
                    <div class="leftside">
                    <label>Full Name : <?php echo $row['p_name']; ?></label>
                    <label>Gender : <?php echo $row['p_gender']; ?></label>
                    <label>Contact : <?php echo $row['p_contact']; ?></label>
                    </div>
                    <div class="rightside">
                    <label>Age : <?php echo $row['p_age']; ?></label><br><br>
                    <label>Patient ID : <?php echo $row['p_id']; ?></label><br><br>
                    <label>Address : <?php echo $row['p_address']; ?></label><br><br>
                </div>
                </div>

                <div class="line" style="height: 5px; width:80%; background-color:#0D6DFD;"></div>

                <!-- Step 1: Select Department -->
                 <div class="form">
                <form method="POST" action="pbook.php">
                    <label>Select Department:</label>
                    <select name="dept_id" required>
                        <option value="" hidden>Select Department</option>
                        <?php
                        if ($resultDept->num_rows > 0) {
                            while ($dept = $resultDept->fetch_assoc()) {
                                $selected = (isset($dept_id) && $dept_id == $dept['dept_id']) ? "selected" : "";
                                echo "<option value='{$dept['dept_id']}' $selected>{$dept['dept_name']}</option>";
                            }
                        }
                        ?>
                    </select>
                    <button type="submit" name="show_doctors" class="btn">Confirm</button>
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
                       <input type="date" name="appointment_date" min="<?php echo date('Y-m-d'); ?>" required>

                        <label>Appointment Time:</label>
                        <!-- <input type="time" name="appointment_time" step="600" required>  -->
                        <select name="appointment_time" required>
                        <?php
                        $start = strtotime("09:00");
                        $end = strtotime("20:00");

                        while ($start <= $end) {
                            $time = date("H:i", $start);
                            echo "<option value='$time'>$time</option>";
                            $start = strtotime("+10 minutes", $start);
                        }
                        ?>
                        </select>
                        <br><br>
                        <button type="submit" name="book_appointment" class="btn2">Book Appointment</button>
                    </form>
                 </div>
                <?php endif; ?>

               <?php if(isset($success_msg)): ?>
    <div class="notify success">
        <h2><?php echo $success_msg; ?></h2>
    </div>
<?php endif; ?>

<?php if(isset($error_msg)): ?>
    <div class="notify error">
        <h2><?php echo $error_msg; ?></h2>
    </div>
<?php endif; ?>

            </div>
        </div>
    </div>
</div>

<script src="reload.js"></script>

</body>
</html>
