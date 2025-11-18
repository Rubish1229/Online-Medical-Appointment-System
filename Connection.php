

<?php
$server="127.0.0.1:3307";
$username="root";
$password="root";
$database="projectfirst";


$con=mysqli_connect($server,$username,$password,$database);
if(!$con)
{
    die("Connection failed ! ".mysqli_connect_error());
}
else{
    // echo"Connection successfull!";
}


?>


