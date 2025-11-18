<?php

require 'Connection.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $h_name = $_POST['hname'];
    $h_email = $_POST['hemail'];
    $h_contact = $_POST['hcontact'];
    $h_address = $_POST['haddress'];
    $h_licensenum = $_POST['hlicensenum'];


    $sql = "INSERT INTO hospital(h_name,h_email,h_contact,h_address,h_licensenum) VALUES (?,?,?,?,?)";
    $stmt = $con->prepare($sql);
     $stmt-> bind_param("ssisi",$h_name,$h_email,$h_contact,$h_address,$h_licensenum);

    if ($stmt->execute()) {
        echo "Hospital registered successfully!";
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
    <h2>Dcotor signup form</h2>
    <div class="form">
        <form action="" method="POST">
            <label>Hospital name</label>
            <input type="text" name="hname" placeholder="Hospital name"><br>

            <label>Hospital email</label>
            <input type="text" name="hemail" placeholder="Hospital email"><br>

            <label>Hospital contact</label>
            <input type="text" name="hcontact" placeholder="Hospital contact"><br>

            <label>Hospital address</label>
            <input type="text" name="haddress" placeholder="Hospital address"><br>

            <label>Hospital license number</label>
            <input type="text" name="hlicensenum" placeholder="Hospital license"><br>

            <button type="submit">Signup</button>
        </form>

    </div>
</body>

</html>