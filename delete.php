<?php



require 'Connection.php';

//adminpage 
$id=$_GET['h_id'];
 $sql="DELETE FROM hospital WHERE h_id=$id";

 if($con->query($sql)){
    header("Location : admin.php");
 }else echo "Error in deleteion!";



 
?>