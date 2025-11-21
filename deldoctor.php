<?php

require 'Connection.php';

//Doctorlist form hdoctorlist.php deleting doctor
 $id2=$_GET['d_id'];
 $sql="DELETE FROM doctor WHERE d_id=$id2 ";


   if($con->query($sql)){
     echo "<script>
            alert('Deleted successfully!');
            window.location.href = 'hospitalpatientlist.php';
          </script>";
    exit;
 }else echo "Error in deleting patient from list";
 
?>