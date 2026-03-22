<?php

require 'auth3.php';
require 'Connection.php';


$h_id = $_SESSION['h_id'];

$sql="SELECT *,d_name 
FROM medicalcard 
JOIN sampledoctor ON doctor_id = d_id
ORDER BY appointment_date ASC,appointment_time ASC";

$result=$con->query($sql);



if (isset($_GET['delete_id'])) {

    $delete_id = intval($_GET['delete_id']);

    $stmtDel = $con->prepare("DELETE FROM medicalcard WHERE card_id = ?");
    $stmtDel->bind_param("i", $delete_id);

    if ($stmtDel->execute()) {

        if ($stmtDel->affected_rows > 0) {
            header("Location: hpatientbooklist.php?msg=deleted");
        } else {
            die("Delete failed: Record is referenced by another table.");
        }

    } else {
        die("SQL Error: " . $stmtDel->error);
    }

    exit();
}







?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="home.css">
    
</head>
<style>
    /* Main Content Wrapper */
.patientBookingList {
    display: flex;
    margin-right: 20px;
    gap: 10px;
}

/* Left Sidebar */
.patientBookingListLeft {
    background-color: #0D6DFD;
    flex: 0 0 300px;
    min-height: 100vh;
    padding: 20px 10px;
    border-radius: 8px;
    text-align: center;
}

.patientBookingListLeft ul {
    list-style: none;
    padding: 0;
    margin-top: 100px;
}

.patientBookingListLeft ul li {
    margin-bottom: 25px;
    font-size: 18px;
}

.patientBookingListLeft ul li a {
    color: #ffffff;
    text-decoration: none;
    font-weight: 500;
    display: block;
    padding: 8px 10px;
    border-radius: 6px;
}

.patientBookingListLeft ul li a:hover {
    background-color: rgba(255, 255, 255, 0.2);
}

/* Right Content Area */
.patientBookingListRight {
    flex: 1;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 6px 18px rgba(0, 0, 0, 0.12);
}

   .booking-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 30px;
    font-family: Arial, Helvetica, sans-serif;
}

/* Table Header */
.booking-table th {
    background-color: #0D6DFD;
    color: #ffffff;
    padding: 22px;
    text-align: center;
    font-size: 14px;
}

/* Table Data */
.booking-table td {
    padding: 10px;
    border: 1px solid #dddddd;
    text-align: center;
    font-size: 13px;
}

/* Alternate Row Color */
.booking-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

/* Hover Effect */
.booking-table tr:hover {
    background-color: #eef4ff;
}

/* Action Links */
.booking-table a {
    text-decoration: none;
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 12px;
}

.booking-table a:first-child {
    background-color: #0D6DFD;
    color: #ffffff;
    margin-right: 6px;
}

.booking-table a:last-child {
    background-color: #dc3545;
    color: #ffffff;
}

.booking-table a:hover {
    opacity: 0.85;
}

/* 
//for button */


/* Action Button Container */
.action-buttons {
    display: flex;
    justify-content: center;
    gap: 8px;
}

/* Common Button Style */
.action-buttons a {
    min-width: 60px;
    text-align: center;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 500;
    text-decoration: none;
    transition: 0.25s ease;
}

/* Edit Button */
.btn-edit {
    background-color: #0D6DFD;
    color: #ffffff;
}

.btn-edit:hover {
    background-color: #084ecf;
}

/* Delete Button */
.btn-delete {
    background-color: #dc3545;
    color: #ffffff;
}

.btn-delete:hover {
    background-color: #b52a37;
}

.table-wrapper {
    width: 100%;
    overflow-x: auto;   /* Enables horizontal scroll */
}
.booking-table {
    min-width: 900px;   /* Increase width */
}


</style>
<body>

<?php include 'navbar2.php';  ?>


<div class="patientBookingList">

<div class="patientBookingListLeft">
        <ul>
            <li><a href="hpatientbooklist.php" style="color:orange;">Booking list</a></li>
        <li><a href="hospitalpatientlist.php">Patient signup list</a></li>
        <li><a href="hdoctorlist.php">Doctor signup list</a></li>
        <li><a href="hdepartment.php">Department list</a></li>
        </ul>
    </div> 

  


  <div class="patientBookingListRight">
<h3  style="text-align: center; margin-top:80px; font-size:25px;">Patient's Booking List</h3>

<?php if($result->num_rows>0):?>
    
<div class="table-wrapper">
   
    <table style="border-collapse: collapse;" class="booking-table">
    <tr>
        <!-- <th>Patient_id</th> -->
        <th>Patient name</th>
        <th>Patient age</th>
        <th>Patient gender</th>
        <th>Patient address</th>
        <th>Patient contact</th>
        <th>Doctor name</th>
        <th>Department name</th>
        <th>Appointment date</th>
        <th>Appointment time</th>
        <th>Actions</th>

       </tr> 

      <?php while($row=$result->fetch_assoc()) : ?>
        <tr>
               <!-- <td><?= $row['patient_id'] ?></td> -->
                <td><?= $row['patientName'] ?></td>
                <td><?= $row['patientAge'] ?></td>
                <td><?= $row['patientGender'] ?></td>
                <td><?= $row['patientAddress'] ?></td>
                <td><?= $row['patientContact'] ?></td>
                <td><?= $row['d_name'] ?></td>
                <td><?= $row['departmentName'] ?></td>
                <td><?= $row['appointment_date'] ?></td>
                <td><?= $row['appointment_time'] ?></td>
                <td>
                      <div class="action-buttons">
                   <!-- <a href="practise.php?edit_id=<?= $row['card_id'] ?>">Edit</a> -->

                   <a class="btn-delete"
   href="hpatientbooklist.php?delete_id=<?= $row['card_id'] ?>"
   onclick="return confirm('Are you sure?')">
   Delete
</a>
  </div>
                </td>

      </tr>
      <?php endwhile; ?>
    </div>
      </table>
            <?php else: ?>
    <p>No appointments found.</p>
<?php endif; ?>

</div>
</div>
 <script src="reload.js"></script>
</body>
</html>