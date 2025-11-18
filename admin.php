

<?php
 
require 'Connection.php';

$sql="SELECT * FROM hospital";
$result=$con->query($sql);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <nav>
        <img src="images/SWASTHYA.png" alt="logo">
    </nav>

    <div class="mainDiv">
        <div class="adminLeft">hello</div>
        <div class="adminRight">

         <table border="1" cellpadding="6" class="tb">
        <tr>
            <th>HospitalID</th>
            <th>HospitalName</th>
            <th>HospitalEmail</th>
            <th>HospitalContact</th>
            <th>HospitalAddress</th>
            <th>HospitalLicenseNum</th>
            <th>Signup date/time</th>
            <th>Actions</th>
        </tr>
        <?php
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc()){
                echo "<tr>";
                echo "<td>".$row['h_id']."</td>";
                echo "<td>".$row['h_name']."</td>";
                echo "<td>".$row['h_email']."</td>";
                echo "<td>".$row['h_contact']."</td>";
                echo "<td>".$row['h_address']."</td>";  
                echo "<td>".$row['h_licensenum']."</td>";  
                echo "<td>".$row['h_createddate']."</td>";  

                echo"<td>
                    <a href='update.php?id=".$row['h_id']."'class='update'>UPDATE</a> | 
                    <a href='delete.php?h_id=".$row['h_id']."'class='delete'>DELETE</a>  
                </td>";
                echo "</tr>";
            }
        }

        ?>

    </table>

        
        </div>
    </div>
</body>
</html>