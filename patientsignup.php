<?php

require 'Connection.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $p_name = $_POST['pname'];
    $p_email = $_POST['pemail'];
    $p_pwd = $_POST['ppwd'];
    $p_contact = $_POST['pcontact'];
    $p_address = $_POST['paddress'];
    $p_gender= $_POST['pgender'];


    $sql = "INSERT INTO patient(p_name,p_email,p_pwd,p_contact,p_address,p_gender) VALUES (?,?,?,?,?,?)";
    $stmt = $con->prepare($sql);
     $stmt-> bind_param("ssssss",$p_name,$p_email,$p_pwd,$p_contact,$p_address,$p_gender);

    if ($stmt->execute()) {
        echo "Patient registered successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Patient signup form</h2>
    <div class="form">
        <form action="" method="POST">
            <label>Patient name</label>
            <input type="text" name="pname" placeholder="Patient full name"><br>

            <label>Patient email</label>
            <input type="text" name="pemail" placeholder="Patient email"><br>

            <label>Patient password</label>
            <input type="text" name="ppwd" placeholder="Patient password"><br>

            <label>Patient contact</label>
            <input type="text" name="pcontact" placeholder="Patient contact"><br>

            <label>Patient address</label>
            <input type="text" name="paddress" placeholder="Patient address"><br>

              <label>Patient gender</label>
            <input type="radio" name="pgender" value="Male">Male<br>
            <input type="radio" name="pgender" value="Female">Female<br>


           

            <button type="submit">Signup</button>
        </form>

    </div>
</body>

</html>