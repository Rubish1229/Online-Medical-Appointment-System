<?php
session_start();
require 'Connection.php';

if (!isset($_GET['edit_id'])) {
    die("Error: No card ID provided.");
}

$card_id = (int) $_GET['edit_id'];

/* ===============================
   FETCH EXISTING CARD DATA
================================ */
$stmt = $con->prepare(
    "SELECT diagnosis, prescription 
     FROM medicalcard 
     WHERE card_id = ?"
);
$stmt->bind_param("i", $card_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Medical card not found.");
}

$row = $result->fetch_assoc();
$upload_message = "";

/* ===============================
   HANDLE UPDATE + FILE UPLOAD
================================ */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* ---- Update Diagnosis & Prescription ---- */
    if (isset($_POST['update'])) {

        $diagnosis = $_POST['diagnosis'];
        $prescription = $_POST['prescription'];

        $update = $con->prepare(
            "UPDATE medicalcard 
             SET diagnosis = ?, prescription = ? 
             WHERE card_id = ?"
        );
        $update->bind_param("ssi", $diagnosis, $prescription, $card_id);

        if ($update->execute()) {
            $upload_message = "Medical details updated successfully.";
        } else {
            $upload_message = "Update failed.";
        }
    }

    /* ---- File Upload ---- */
    if (isset($_POST['upload_file']) && !empty($_FILES['medical_file']['name'])) {

        $fileTmpPath = $_FILES['medical_file']['tmp_name'];
        $fileName = $_FILES['medical_file']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx'];

        if (in_array($fileExtension, $allowedExtensions)) {

            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $newFileName = uniqid('file_', true) . '.' . $fileExtension;
            $filePath = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $filePath)) {

                $insert = $con->prepare(
                    "INSERT INTO medical_files (card_id, file_name, file_path)
                     VALUES (?, ?, ?)"
                );
                $insert->bind_param("iss", $card_id, $fileName, $filePath);

                if ($insert->execute()) {
                    $upload_message = "File uploaded successfully.";
                } else {
                    $upload_message = "Database error while saving file.";
                }

            } else {
                $upload_message = "File upload failed.";
            }

        } else {
            $upload_message = "Invalid file type.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Medical Card</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="./css/image.css">
    <style>
        .doctorEdit {
            margin: auto;
            border: 2px solid #0D6DFD;
            width: 565px;
            padding: 30px;
            border-radius: 7px;
        }
        .doctorEditbtn {
            background: #0D6DFD;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            display: block;
            margin: 20px auto;
        }
        h2{
            margin-top: 85px;
            margin-bottom: 30px;
        }

        .btn-group {
    display: flex;
    justify-content: space-around;
    gap: -60px;              /* Space between buttons */
    margin-top: 15px;
}

    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<h2 style="text-align:center;">Edit Diagnosis & Prescription</h2>

<div class="doctorEdit">

<form method="POST" enctype="multipart/form-data">

    <label>Diagnosis</label><br>
    <textarea name="diagnosis" rows="6" cols="60"><?= htmlspecialchars($row['diagnosis']) ?></textarea><br><br>

    <label>Prescription</label><br>
    <textarea name="prescription" rows="6" cols="60"><?= htmlspecialchars($row['prescription']) ?></textarea><br><br>

    <label>Attach Medical File</label><br>
    <input type="file" name="medical_file"><br><br>

    <div class="btn-group">
    <button type="submit" name="upload_file" class="doctorEditbtn">Upload File</button>
    <button type="submit" name="update" class="doctorEditbtn">Update</button>
    </div>
</form>

<?php
if (!empty($upload_message)) {
    echo "<p style='margin-top:15px;color:green;text-align:center;'>"
        . htmlspecialchars($upload_message) .
        "</p>";
}
?>

</div>

</body>
</html>
