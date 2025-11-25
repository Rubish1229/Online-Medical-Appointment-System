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
        /* width: 68%; */
         border-collapse: collapse; 
         margin:auto; 
        
     
         -webkit-overflow-scrolling: touch; 
    }
    
    
    .tb th, .tb td {
        padding: 13px;           /* increase padding inside cells */
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

<?php include 'navbar.php'  ?>


 

    
    <div class="mainDiv">
        <div class="adminLeft hospitalleft">
            <ul>
                <li> <a href="">Appoinments</a></li>
                <li> <a href="">Departments</a></li>
                <li> <a href="hdoctorlist.php">Doctors</a></li>
                <li> <a href="">Patients</a></li>
               
            </ul>
</div>
        <div class="adminRight">
            <br>
            

        <form action="GET">
        <?php
        echo "<h3>Patients signup lists</h3>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        ?>
        <div class="table-responsive">

         <table border="1" cellpadding="6" class="tb">
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
                echo "<td>".$row['p_datetime']."</td>";  
               

                echo"<td>
                    <a href='hpatientupdate.php?p_id=".$row['p_id']."' class='update'>UPDATE</a> | 
                    <a href='delpatientid=".$row['p_id']."' class='delete'>DELETE</a>  
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