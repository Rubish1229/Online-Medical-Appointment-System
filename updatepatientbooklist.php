<?php
require 'Connection.php';

// --------------------------------------------------
// 1. LOAD DEPARTMENTS FOR FIRST DROPDOWN
// --------------------------------------------------
$resultDept = $con->query("SELECT dept_id, dept_name FROM department");

// --------------------------------------------------
// 2. LOAD EXISTING MEDICAL CARD DATA
// --------------------------------------------------
if (isset($_GET['card_id'])) {
    $card_id = $_GET['card_id'];

    $stmt = $con->prepare("SELECT * FROM medicalcard WHERE card_id=?");
    $stmt->bind_param("i", $card_id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();

    // Always load dept_id
    $dept_id = $row['department_id'];
}


// --------------------------------------------------
// 3. SHOW DOCTORS OF SELECTED DEPARTMENT
// --------------------------------------------------
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


if (isset($_POST['update'])) {
    $card_id    = $_POST['card_id'];
    $dept_id    = $_POST['dept_id'];
    $doctor_id  = $_POST['doctor_id'];
    $date       = $_POST['appointment_date'];
    $time       = $_POST['appointment_time'];

    // Get department name
    $stmtDept = $con->prepare("SELECT dept_name FROM department WHERE dept_id=?");
    $stmtDept->bind_param("i", $dept_id);
    $stmtDept->execute();
    $dept_name = $stmtDept->get_result()->fetch_assoc()['dept_name'];

    // Update table
    $sql = "UPDATE medicalcard 
            SET departmentName=?, doctor_id=?, appointment_date=?, appointment_time=? 
            WHERE card_id=?";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("sissi", $dept_name, $doctor_id, $date, $time, $card_id);

    if ($stmt->execute()) {
        echo "<script>alert('Updated successfully'); window.location='hpatientbooklist.php';</script>";
        exit;
    } else {
        echo "Error updating: " . $stmt->error;
    }
}
?>

<!-- --------------------------------------------------
     5. FORM 1 → SELECT DEPARTMENT (SHOW DOCTORS)
---------------------------------------------------- -->

<form method="POST" action="">
    <input type="hidden" name="card_id" value="<?= $row['card_id'] ?>">

    <label>Select Department:</label>
    <select name="dept_id" required>
        <option value="">Select Department</option>
        <?php while ($dept = $resultDept->fetch_assoc()): ?>
            <option value="<?= $dept['dept_id'] ?>">
                <?= $dept['dept_name'] ?>
            </option>
        <?php endwhile; ?>
    </select>

    <button type="submit" name="show_doctors">Show Doctors</button>
</form>

<br>
<hr><br>

<!-- --------------------------------------------------
     6. FORM 2 → UPDATE CARD
---------------------------------------------------- -->

<form method="POST" action="">
    <input type="hidden" name="card_id" value="<?= $row['card_id'] ?>">

    <!-- IMPORTANT: SEND DEPT_ID DURING UPDATE -->
    

    <label>Doctor:</label>
    <select name="doctor_id">
        <?php
        if (!empty($doctors)) {
            // doctors from selected department
            foreach ($doctors as $doc) {
                echo "<option value='{$doc['d_id']}'>{$doc['d_name']}</option>";
            }
        } else {
            // fallback: load all doctors
            $all = $con->query("SELECT d_id, d_name FROM sampledoctor");
            while ($doc = $all->fetch_assoc()) {
                echo "<option value='{$doc['d_id']}'>{$doc['d_name']}</option>";
            }
        }
        ?>
    </select>
    <input type="hidden" name="dept_id" value="<?= $dept_id ?? $row['department_id'] ?>">


    <br><br>

    Appointment Date:
    <input type="date" name="appointment_date" value="<?= $row['appointment_date'] ?>"><br><br>

    Appointment Time:
    <input type="time" name="appointment_time" value="<?= $row['appointment_time'] ?>"><br><br>

    <button type="submit" name="update">Update</button>
</form>