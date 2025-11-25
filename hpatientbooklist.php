<?php

require 'Connection.php';

$sql="SELECT *,d_name 
FROM medicalcard 
JOIN sampledoctor ON doctor_id = d_id
ORDER BY appointment_date ASC,appointment_time ASC";

$result=$con->query($sql);



if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $stmtDel = $con->prepare("DELETE FROM medicalcard WHERE card_id=?");
    $stmtDel->bind_param("i", $delete_id);
    $stmtDel->execute();
    header("Location: hpatientbooklist.php"); // reload page
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
    .patientBookingList{
     margin-left:  240px;
     margin-right: 3px;   
    }
    .patientBookingListLeft{
        background-color: #0D6DFD;
        height:400px;
        width: 140px;
        margin-top: -20px;
        border: 1px solid green;
    }
    .patientBookingListRight{
        height: 100%;
    }
</style>
<body>

<?php include 'navbar.php';  ?>
<br>
<br>
<br>
<br>

<!-- <div class="patientBookingListLeft"> -->
    <ul>
        <li><a href="hpatientbooklist.php">Booking list</a></li>
        <li><a href="hospitalpatientlist.php">Patient signup list</a></li>
        <li><a href="hdoctorlist.php">Doctor signup list</a></li>
        <li><a href="hdepartment.php">Department list</a></li>
    </ul>
</div>


  <div class="patientBookingListRight">
<h3  style="text-align: center; margin:10px;">Hospital patient booking list</h3>

<?php if($result->num_rows>0):?>
    

    <div class="patientBookingList">
    <table style="border-collapse: collapse;" border='1' cellpadding='10'>
    <tr>
        <th>Patient_id</th>
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
                <td>
                   <a href="practise.php?edit_id=<?= $row['card_id'] ?>">Edit</a>

                    <a href="?delete_id=<?= $row['card_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>

      </tr>
      <?php endwhile; ?>
      </table>
            <?php else: ?>
    <p>No appointments found.</p>
<?php endif; ?>

</div>
</div>
</body>
</html>