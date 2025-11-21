<?php


require 'Connection.php';
$id=$_GET['dept_id'];
$sql="DELETE FROM department WHERE dept_id=$id";

if($con->query($sql)){
    echo "<script> 
        alert('Department deleted from the table.');
        window.location.href='hdepartment.php';    
    </script>";
    exit;

}else{
    echo"Error in deleting department";
}
?>