<?php

require 'Connection.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $h_name = $_POST['hname'];
    $h_email = $_POST['hemail'];
    $h_pwd = $_POST['hpwd'];
    $h_contact = $_POST['hcontact'];
    $h_address = $_POST['haddress'];
    $h_licensenum = $_POST['hlicensenum'];


    $sql = "INSERT INTO hospital(h_name,h_email,h_pwd,h_contact,h_address,h_licensenum) VALUES (?,?,?,?,?,?)";
    $stmt = $con->prepare($sql);
     $stmt-> bind_param("sssisi",$h_name,$h_email,$h_pwd,$h_contact,$h_address,$h_licensenum);

    if ($stmt->execute()) {
        echo "Doctor registered successfully!";
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
     <link rel="stylesheet" href="./part/sampleSignup.css">
     <link rel="stylesheet" href="./part/hospitalsignup.css">
     <link rel="stylesheet" href="./part/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

   
  
</head>

<body>
  <?php include 'navbar.php' ?>
    <div class="signupBox">
    <h2>Hospital's signup form</h2>
<div class="category">
                <div class="patientCategory cat"> <a href="patientsignup.php" ><button> Patient</button></a></div>
                <div class="doctorCategory cat"><a href="samplesignup.php" ><button style="background-color: white;"color: black;"> Doctor</a></button></div>
                <div class="hospitalCategory cat"><button style="background-color: #0D6DFD;"><a href="hospitalsignup.php"style="color: white;">Hospital</a></button></div>
            </div>



   
    <div class="form">
        <form action="" method="POST">
            <div class="hospitalSignupBox1">
            <label>Hospital name</label>
            <input type="text" name="hname" placeholder="Hospital name"><br>

            <label>Hospital email</label>
            <input type="text" name="hemail" placeholder="Hospital email"><br>
            </div>

            <div class="hospitalSignupBox1">
                  <label>Hospital password</label>
            <input type="text" name="hpwd" placeholder="Hospital password"><br>

            <label>Hospital contact</label>
            <input type="text" name="hcontact" placeholder="Hospital contact"><br>
</div>
            <div class="hospitalSignupBox1">
            <label>Hospital address</label>
            <input type="text" name="haddress" placeholder="Hospital address"><br>

            <label>Hospital license number</label>
            <input type="text" name="hlicensenum" placeholder="Hospital license"><br>
</div>
            <button type="submit" class="sampleSignupbtn">Signup</button>
        </form>

    </div>
</body>

</html>