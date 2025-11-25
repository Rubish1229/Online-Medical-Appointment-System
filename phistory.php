<?php
session_start();
require 'Connection.php';

if (!isset($_SESSION['p_id'])) {
    die("Please login first.");
}

$patient_id = $_SESSION['p_id'];

$sql = "SELECT 
            medicalcard.card_id,
            medicalcard.patient_id,
            medicalcard.patientName,
            medicalcard.patientAge,
            medicalcard.patientGender,
            medicalcard.patientAddress,
            medicalcard.patientContact,
            sampledoctor.d_name,
            medicalcard.departmentName,
            medicalcard.appointment_date,
            medicalcard.appointment_time,
            medicalcard.diagnosis,
            medicalcard.prescription
        FROM medicalcard
        JOIN sampledoctor ON medicalcard.doctor_id = sampledoctor.d_id
        WHERE medicalcard.patient_id = $patient_id";
$result=$con->query($sql);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="hospital.css">
    <link rel="stylesheet" href="pbook.css">
    <link rel="stylesheet" href="./part/login.css">
</head>

<style>
   .adminRight h2{
    margin-top: 30px;
   }

</style>
<body>

<?php include 'navbar.php';?>

    
    <div class="mainDiv">
        <div class="adminLeft pbookleft">
            <ul>
                <li> <a href="pbook.php">Appoinments</a></li>
                <li> <a href="phistory.php" style="color:orange">Medical history</a></li>
                
               
            </ul>
</div>
        <div class="adminRight">

        <form action="GET">
        <?php
        echo "<h2>Patient Medical history</h2>";
        echo "<br>";
  
        ?>

        <div class="card-container">

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
        <div class="appointment-card">
            <h3><?= $row['patientName'] ?></h3>

            <p><strong>Gender:</strong> <?= $row['patientGender'] ?></p>
            <p><strong>Age:</strong> <?= $row['patientAge'] ?></p>
            <p><strong>Contact:</strong> <?= $row['patientContact'] ?></p>
            <p><strong>Address:</strong> <?= $row['patientAddress'] ?></p>

            <hr>

            <p><strong>Doctor:</strong> <?= $row['d_name'] ?></p>
            <p><strong>Department:</strong> <?= $row['departmentName'] ?></p>

            <hr>

            <p><strong>Diagnosis:</strong> <?= $row['diagnosis'] ?></p>
            <p><strong>Prescription:</strong> <?= $row['prescription'] ?></p>

            <hr>

            <p><strong>Date:</strong> <?= $row['appointment_date'] ?></p>
            <p><strong>Time:</strong> <?= $row['appointment_time'] ?></p>
        </div>
        <br>
        <br>
        <br>
<?php
    }
}
?>

</div>

    </form>

        
        </div>
    </div>
    
</body>
</html>