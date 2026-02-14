<?php

require 'Connection.php';

$sql="SELECT * FROM patient";
$result=$con->query($sql);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="hospital.css">
    <link rel="stylesheet" href="./css/utility.css">

</head>

<style>
h3{
    margin-top: 40px;
    text-align: center;
    font-size: 20px;
}
    
</style>
<body>

<?php include 'navbar.php'  ?>


   
<div class="patientBookingList">

<div class="patientBookingListLeft">
            <ul>
            <li><a href="hpatientbooklist.php">Booking list</a></li>
        <li><a href="hospitalpatientlist.php"style="color:orange;" >Patient signup list</a></li>
        <li><a href="hdoctorlist.php">Doctor signup list</a></li>
        <li><a href="hdepartment.php">Department list</a></li>
        </ul>
</div>



     <div class="patientBookingListRight">
          
        <form action="GET">
        <?php
        echo "<h3>Patients signup lists</h3>";
      
        ?>
        <div class="booking-table">
    <table style="border-collapse: collapse;">
        <tr>
            <th>PatientID</th>
            <th>PatientName</th>
            <th>PatientEmail</th>
            <th>Patientpwd</th>
            <th>PatientContact</th>
            <th>PatientAddress</th>
            <th>Patientgender</th>
            <th>patient Signup date/time</th>
            <th>Actions</th>
        </tr>
        <?php
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc()){
                echo "<tr>";
                echo "<td>".$row['p_id']."</td>";
                echo "<td>".$row['p_name']."</td>";
                echo "<td>".$row['p_email']."</td>";
                echo "<td>".$row['p_pwd']."</td>";
                echo "<td>".$row['p_contact']."</td>";
                echo "<td>".$row['p_address']."</td>";  
                echo "<td>".$row['p_gender']."</td>";  
                echo "<td>".$row['p_signupdatetime']."</td>";  
               


                  echo "<td>
        <div class='action-buttons'>
            <a href='hpatientupdate.php?p_id=".$row['p_id']."' class='update'>UPDATE</a> | 
            <a href='delpatient.php?delete_id=".$row['p_id']."' class='delete'>DELETE</a>
        </div>
      </td>";
echo "</tr>";

            }
        }

        ?>
        </div>

    </table>
    </form>

        
        </div>
    </div>
    
</body>
</html>