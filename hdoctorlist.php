<?php

require 'Connection.php';

$sql="SELECT * FROM sampledoctor";
$result=$con->query($sql);

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
</head>

<style>
    .table-responsive {
  width: 98%;   
  max-height: 500px;        /* full width container */
  overflow-x: auto;      
  overflow-y: auto;      
       
  -webkit-overflow-scrolling: touch;  /* smooth scrolling on mobile */
  margin: auto;          /* center it if smaller */
}
     .tb{
        width: 68%;
         border-collapse: collapse; 
         margin:auto; 
        
     
         -webkit-overflow-scrolling: touch; 
    }
    
    
    .tb th, .tb td {
        padding: 15px;            /* increase padding inside cells */
        border: 1px solid #000;   /* single clean border */
        text-align: left;
    }
    .tb th {
        background: #0D6DFD; 
        color: white;     /* optional: header background */
    } 

    .table-responsive::-webkit-scrollbar {
  height: 10px;   
  width: 10px;            /* scrollbar height (horizontal) or width (vertical) */
  background-color: #b8d4ffff;  /* track background */
}

.table-responsive::-webkit-scrollbar-thumb {
  background-color: #0D6DFD;     /* scrollbar thumb color */
  border-radius: 10px;        /* rounded corners */
}

.table-responsive::-webkit-scrollbar-thumb:hover {
  background-color: #555;     /* darker on hover */
}
</style>
<body>
    
<?php include'navbar.php'  ?>

    
    <div class="mainDiv">
        <div class="adminLeft hospitalleft">
            <ul>
                <li> <a href="">Booking lists</a></li>
                <li> <a href="hdepartment.php">Patient Signup list</a></li>
                <li> <a href="hdoctorlist.php">Doctor Signup list</a></li>
                <li> <a href="hospitalpatientlist.php">Patients</a></li>
               
            </ul>
</div>
        <div class="adminRight">
        <br>
        <form action="GET">
        <?php
        echo "<h3>Doctors signup lists</h3>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        ?>

        <div class="table-responsive">

         <table border="1" cellpadding="6" class="tb">
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
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc()){
                echo "<tr>";
                echo "<td>".$row['d_id']."</td>";
                echo "<td>".$row['d_name']."</td>";
                echo "<td>".$row['d_email']."</td>";
                echo "<td>".$row['d_pwd']."</td>";
                echo "<td>".$row['d_gender']."</td>";  
                echo "<td>".$row['d_address']."</td>";  
                echo "<td>".$row['d_contact']."</td>";
                echo "<td>".$row['d_licensenum']."</td>";
                echo "<td>".$row['d_signupdatetime']."</td>";  
                echo "<td>".$row['department_id']."</td>";
                echo "<td>".$row['department_name']."</td>";
                

                echo"<td>
                    <a href='hdoctorupdate.php?d_id=".$row['d_id']."' class='update'>UPDATE</a> | 
                    <a href='deldoctor.php?d_id=".$row['d_id']."' class='delete'>DELETE</a>  
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