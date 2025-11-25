<?php
require 'Connection.php';

if (!isset($_GET['edit_id'])) {
    die("Error: No card ID.");
}

$card_id = $_GET['edit_id'];

// Fetch the medical card data
$stmt = $con->prepare("SELECT diagnosis, prescription FROM medicalcard WHERE card_id = ?");
$stmt->bind_param("i", $card_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Error: Card not found.");
}

$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $diagnosis = $_POST['diagnosis'];
    $prescription = $_POST['prescription'];

    $update = $con->prepare("UPDATE medicalcard SET diagnosis=?, prescription=? WHERE card_id=?");
    $update->bind_param("ssi", $diagnosis, $prescription, $card_id);

    if ($update->execute()) {
        echo "Updated successfully!";
        header("Location: doctorpatientbooklist.php"); 
        exit();
    } else {
        echo "Update failed: " . $con->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Diagnosis & Prescription</title>
    <link rel="stylesheet" href="home.css">
</head>
<style>

    .doctorEdit{
        margin: auto;
        border: 1px solid #0D6DFD;
        height: 450px;
        width: 550px;
        padding: 30px 30px;
    }
    .doctorEditbtn{
        background-color: #0D6DFD;
        color: white;
        height: 40px;
        width: 80px;
        border-radius: 12px;
        transition: all 0.5s ease;
        display: flex;
        margin: auto;
        padding: 10px 15px;
    }
    .doctorEditbtn:hover{
        border-radius: 20px;
        cursor: pointer;
    }
</style>
<body>

<?php include'navbar.php' ?>
<br>
<br>
<br>
<br>

<h2 style="text-align: center; margin:30px;">Edit Details</h2>

<div class="doctorEdit">
<form method="POST">
    <label>Diagnosis:</label><br>
    <textarea name="diagnosis" rows="8" cols="57"><?= $row['diagnosis'] ?></textarea><br><br>

    <label>Prescription:</label><br>
    <textarea name="prescription" rows="6" cols="57"><?= $row['prescription'] ?></textarea><br><br>

    <button type="submit" class="doctorEditbtn">Update</button>
</form>

</div>
</body>
</html>
