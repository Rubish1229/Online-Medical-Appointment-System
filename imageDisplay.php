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




$result = $con->query($sql);

$files_sql = "SELECT file_name, file_path 
              FROM medical_files 
              WHERE card_id = ?";
$stmt = $con->prepare($files_sql);
$stmt->bind_param("i", $row['card_id']);
$stmt->execute();
$files = $stmt->get_result();



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
    <link rel="stylesheet" href="./css/imageDisplay.css">
</head>

<style>
   .adminRight h2{
    margin-top: 30px;
   }
   .card-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 20px;
    max-height: 550px;
    overflow: scroll;
}

.appointment-card {
    background: #ffffff;
    border: 1px solid #ddd;
    border-left: 6px solid #0D6DFD;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0,0,0,0.08);
}

.appointment-card h3 {
    color: #0D6DFD;
    margin-bottom: 10px;
}

.appointment-card p {
    margin: 5px 0;
    font-size: 15px;
}

.appointment-card hr {
    margin: 12px 0;
    border: none;
    border-top: 1px solid #eee;
}


/* /for images */
.file-list {
    margin-top: 10px;
}

.medical-image {
    width: 200px;
    height: auto;
    border-radius: 6px;
    margin-top: 8px;
    border: 1px solid #ccc;
    transition: all 0.5s ease;
}
.medical-image:hover{
    width: 450px;
    height: auto;
    border-radius: 6px;
    cursor: pointer;
}



</style>
<body>

<?php include 'navbar.php';?>

    
    <div class="mainDiv" style="display: flex;">
       
       <div class="adminLeft pbookleft">
        <ul>
            <li><a href="pbook.php" >Book appointment</a></li>
            <!-- <li><a href="#">Appointment queue</a></li> -->
            <li><a href="phistory.php" style="color: orange;">History</a></li>
        </ul>
    </div>  
        <div class="adminRight">

        <form action="GET">
        <?php
        
        echo "<h2>Patient Medical history</h2>";
        echo "<br>";
  
        ?>

        <div class="card-container">

<div class="card-container">
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
    <div class="appointment-card">
        <h3><?= htmlspecialchars($row['patientName']) ?></h3>

        <p><strong>Gender:</strong> <?= htmlspecialchars($row['patientGender']) ?></p>
        <p><strong>Age:</strong> <?= htmlspecialchars($row['patientAge']) ?></p>
        <p><strong>Contact:</strong> <?= htmlspecialchars($row['patientContact']) ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($row['patientAddress']) ?></p>

        <hr>

        <p><strong>Doctor:</strong> <?= htmlspecialchars($row['d_name']) ?></p>
        <p><strong>Department:</strong> <?= htmlspecialchars($row['departmentName']) ?></p>

        <hr>

        <p><strong>Diagnosis:</strong> <?= nl2br(htmlspecialchars($row['diagnosis'])) ?></p>
        <p><strong>Prescription:</strong> <?= nl2br(htmlspecialchars($row['prescription'])) ?></p>

        <hr>

        <p><strong>Date:</strong> <?= htmlspecialchars($row['appointment_date']) ?></p>
        <p><strong>Time:</strong> <?= htmlspecialchars($row['appointment_time']) ?></p>

<div class="file-list">
    <strong>Attached Files:</strong><br>

<?php
$files_sql = "SELECT file_name, file_path FROM medical_files WHERE card_id = ?";
$stmt = $con->prepare($files_sql);
$stmt->bind_param("i", $row['card_id']);
$stmt->execute();
$files = $stmt->get_result();

if ($files->num_rows > 0) {
    while ($file = $files->fetch_assoc()) {

        $path = htmlspecialchars($file['file_path']);
        $name = htmlspecialchars($file['file_name']);
        $realPath = $_SERVER['DOCUMENT_ROOT'] . '/projects/OnlineMedicalSystem/' . $file['file_path'];


        if (file_exists($realPath)) {

            if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $path)) {
                echo "<img src='$path' class='medical-image'><br>";
            } else {
                echo "<a href='$path' target='_blank'>$name</a><br>";
            }

        }
    }
} else {
    echo "<p>No files attached.</p>";
}
?>
</div>

<?php
    }
} else {
    echo "<p>No medical history found.</p>";
}
?>
</div>



</div>

    </form>

        
        </div>
    </div>
    
</body>
</html>