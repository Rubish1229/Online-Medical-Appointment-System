<?php

require 'Connection.php';

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$sql = "SELECT sampledoctor.*, department.dept_name
        FROM sampledoctor
        JOIN department ON sampledoctor.department_id = department.dept_id";

$result = $con->query($sql);

if (!$result) {
    die("Query failed: " . $con->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="hospital.css">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="./css/utility.css">
</head>

<style>
    .booking-table {
    max-width: 1140px; /* or 50vw */
    overflow-x: auto;
    margin: auto;
    margin-top: 50px; /* better to use auto for horizontal scroll */
}
h3{
    margin-top: 70px;
    text-align: center;
}
</style>
<body>
    
<?php include'navbar.php'  ?>

   <div class="patientBookingList">

<div class="patientBookingListLeft">
            <ul>
            <li><a href="hpatientbooklist.php">Booking list</a></li>
        <li><a href="hospitalpatientlist.php" >Patient signup list</a></li>
        <li><a href="hdoctorlist.php"style="color:orange;">Doctor signup list</a></li>
        <li><a href="hdepartment.php">Department list</a></li>
        </ul>
</div>
         <div class="patientBookingListRight">
        <form action="GET">
        <?php
        echo "<h3>Doctors signup lists</h3>";
      
        ?>

         <div class="booking-table">
    <table style="border-collapse: collapse;">
        <tr>
            <th>DoctorID</th>
            <th>DoctorName</th>
            <th>DoctorEmail</th>
            <th>Doctorpwd</th>
            <th>DoctorGender</th>
            <th>DoctorAddress</th>
            <th>DoctorContact</th>
            <th>DoctorLicenseNum</th>
            <th>Doctor Signup date/time</th>
            <th>Department_id</th>
            <th>Department_name</th>
            <th>Actions</th>
        </tr>
        <?php
       if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".htmlspecialchars($row['d_id'])."</td>";
        echo "<td>".htmlspecialchars($row['d_name'])."</td>";
        echo "<td>".htmlspecialchars($row['d_email'])."</td>";
        echo "<td>".htmlspecialchars($row['d_pwd'])."</td>";
        echo "<td>".htmlspecialchars($row['d_gender'])."</td>";
        echo "<td>".htmlspecialchars($row['d_address'])."</td>";
        echo "<td>".htmlspecialchars($row['d_contact'])."</td>";
        echo "<td>".htmlspecialchars($row['d_licensenum'])."</td>";
        echo "<td>".htmlspecialchars($row['d_signupdatetime'])."</td>";
        echo "<td>".htmlspecialchars($row['department_id'])."</td>";
        echo "<td>".htmlspecialchars($row['dept_name'])."</td>";
        echo "<td>
                <div class='action-buttons'>
                    <a href='hdoctorupdate.php?d_id=".urlencode($row['d_id'])."' class='update'>UPDATE</a> | 
                    <a href='deldoctor.php?d_id=".urlencode($row['d_id'])."' class='delete' onclick=\"return confirm('Are you sure you want to delete this doctor?')\">DELETE</a>  
                </div>
              </td>";
        echo "</tr>";
    }
}

        ?>

    </table>
    </div>
    </form>

        
        </div>
    </div>
    

</body>
</html>