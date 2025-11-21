
<?php

//patinetlist from hospital page
 $id1=$_GET['p_id'];

 $sql="DELETE FROM patient WHERE p_id=$id1";

 if($con->query($sql)){
     echo "<script>
            alert('Deleted successfully!');
            window.location.href = 'hospitalpatientlist.php';
          </script>";
    exit;
 }else echo "Error in deleting patient from list";


?>