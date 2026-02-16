
<?php

require 'Connection.php';   // 🔹 include database connection

// 🔹 Check if parameter exists
if(isset($_GET['delete_id'])){

    $id1 = $_GET['delete_id'];

    // 🔹 Safer query (prevent SQL issues)
    $sql = "DELETE FROM patient WHERE p_id='$id1'";

    if($con->query($sql)){
        echo "<script>
                alert('Deleted successfully!');
                window.location.href='hospitalpatientlist.php';
              </script>";
        exit;
    }
    else{
        echo "Error deleting patient: " . $con->error;
    }

}

?>