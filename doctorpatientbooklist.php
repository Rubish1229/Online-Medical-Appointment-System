<?php
session_start();
require 'Connection.php';

if (!isset($_SESSION['doctor_id'])) {
    die("Please login first.");
}

$doctor_id = $_SESSION['doctor_id'];

// Proper SQL with JOINs
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
        WHERE sampledoctor.d_id = $doctor_id";

$result = $con->query($sql);

if (!$result) {
    die("SQL Error: " . $con->error);
}

if ($result->num_rows > 0) {
    // Display table
} else {
    echo "No appointments found.";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointments</title>
    <link rel="stylesheet" href="home.css">
</head>
<style>
    h3{
        text-align: center;
        margin: 20px 0px;
    }
</style>
<body>
<?php include 'navbar.php' ?>
<br>
<br>
<br>
<br>

<h3>Doctor's Appointment List</h3>

<div class="appointmentTable">
<?php if($result->num_rows > 0): ?>
    <table style="border-collapse: collapse;"border='1' cellpadding='10'>
        <tr>
            <th>Patient ID</th>
            <th>Patient Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Contact</th>
            <th>Doctor Name</th>
            <th>Department</th>
            <th>Appointment Date</th>
            <th>Appointment Time</th>
            <th>Diagnosis</th>
            <th>Prescription</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['patient_id'] ?></td>
            <td><?= $row['patientName'] ?></td>
            <td><?= $row['patientAge'] ?></td>
            <td><?= $row['patientGender'] ?></td>
            <td><?= $row['patientAddress'] ?></td>
            <td><?= $row['patientContact'] ?></td>
            <td><?= $row['d_name'] ?></td>
            <td><?= $row['departmentName'] ?></td>
            <td><?= $row['appointment_date'] ?></td>
            <td><?= $row['appointment_time'] ?></td>
            <td><?= $row['diagnosis'] ?></td>
            <td><?= $row['prescription'] ?></td>
            <td>
                <a href="doctorpatientEdit.php?edit_id=<?= $row['card_id'] ?>">Edit</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>No appointments found.</p>
<?php endif; ?>

</div>

</body>
</html>
