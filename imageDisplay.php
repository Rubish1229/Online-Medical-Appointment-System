<?php
session_start();
require 'Connection.php';

if (!isset($_SESSION['p_id'])) {
    die("Please login first.");
}

$patient_id = $_SESSION['p_id'];
$fileUploaded = false;

/* Fetch medical history */
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
        WHERE medicalcard.patient_id = ?";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Medical History</title>

    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="hospital.css">
    <link rel="stylesheet" href="pbook.css">
    <link rel="stylesheet" href="./part/login.css">
    <link rel="stylesheet" href="./css/imageDisplay.css">

    <style>
        .card-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 20px;
            max-height: 550px;
            overflow-y: auto;
        }

        .appointment-card {
            background: #fff;
            border-left: 6px solid #0D6DFD;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        .medical-image {
            width: 200px;
            border-radius: 6px;
            margin-top: 8px;
            border: 1px solid #ccc;
            transition: 0.4s;
        }

        .medical-image:hover {
            width: 850px;
            cursor: pointer;
        }
/* 
        for ialog box */
        .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

.modal-box {
    background: #fff;
    padding: 25px 30px;
    border-radius: 10px;
    width: 350px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

.modal-box h3 {
    margin-bottom: 10px;
    color: #0D6DFD;
}

.modal-box p {
    margin-bottom: 20px;
    font-size: 15px;
}

.modal-box button {
    background: #0D6DFD;
    color: white;
    border: none;
    padding: 8px 18px;
    border-radius: 5px;
    cursor: pointer;
}

.modal-box button:hover {
    background: #084ec4;
}

    </style>
</head>

<body>

<?php include 'navbar.php'; ?>

<div class="mainDiv" style="display:flex;">
    
    <div class="adminLeft pbookleft">
        <ul>
            <li><a href="pbook.php">Book appointment</a></li>
            <li><a href="phistory.php" style="color:orange;">History</a></li>
        </ul>
    </div>

    <div class="adminRight">

        <h2>Patient Medical History</h2>

        <div class="card-container">

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>

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

                <p><strong>Diagnosis:</strong><br><?= nl2br(htmlspecialchars($row['diagnosis'])) ?></p>
                <p><strong>Prescription:</strong><br><?= nl2br(htmlspecialchars($row['prescription'])) ?></p>

                <hr>

                <p><strong>Date:</strong> <?= htmlspecialchars($row['appointment_date']) ?></p>
                <p><strong>Time:</strong> <?= htmlspecialchars($row['appointment_time']) ?></p>

                <hr>

                <strong>Attached Files:</strong><br>

                <?php
                $files_sql = "SELECT file_name, file_path FROM medical_files WHERE card_id = ?";
                $stmt2 = $con->prepare($files_sql);
                $stmt2->bind_param("i", $row['card_id']);
                $stmt2->execute();
                $files = $stmt2->get_result();

                if ($files->num_rows > 0) {
                    while ($file = $files->fetch_assoc()) {

                        if (!empty($file['file_path'])) {
                            $fileUploaded = true;
                        }

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

            <?php endwhile; ?>
        <?php else: ?>
            <p>No medical history found.</p>
        <?php endif; ?>

        </div>
    </div>
</div>
<?php if ($fileUploaded): ?>
<div id="uploadModal" class="modal-overlay">
    <div class="modal-box">
        <h3>Notification</h3>
        <p>Report has been uploaded successfully.</p>
        <button onclick="closeModal()">OK</button>
    </div>
</div>
<?php endif; ?>
<script>
function closeModal() {
    document.getElementById('uploadModal').style.display = 'none';
}
</script>


</body>
</html>
