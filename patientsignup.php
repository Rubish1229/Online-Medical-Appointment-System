<?php

require 'Connection.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $p_name = $_POST['pname'];
    $p_email = $_POST['pemail'];
    $p_pwd = $_POST['ppwd'];
    $p_contact = $_POST['pcontact'];
    $p_address = $_POST['paddress'];
    $p_age = $_POST['page'];
    $p_gender= $_POST['pgender'];


    $sql = "INSERT INTO patient(p_name,p_email,p_pwd,p_contact,p_address,p_age,p_gender) VALUES (?,?,?,?,?,?,?)";
    $stmt = $con->prepare($sql);
     $stmt-> bind_param("sssssis",$p_name,$p_email,$p_pwd,$p_contact,$p_address,$p_age,$p_gender);

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
      <link rel="stylesheet" href="./part/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./part/patientSignup.css">    
    <!-- <link rel="stylesheet" href="./part/sampleSignup.css">     -->
</head>


<body>
    <?php include 'navbar.php' ?>
    <div class="patientSignupBox">
    <h1>Patient signup form</h1>
    <div class="category">
                <div class="patientCategory cat"> <button style="background-color: #0D6DFD;"><a href="patientsignup.php" style="color: white; "> Patient</a></button></div>
                <div class="doctorCategory cat"><button style="background-color: white;"><a href="samplesignup.php" style="color: black; "> Doctor</a></button></div>
                <div class="hospitalCategory cat"><button><a href="hospitalsignup.php">Hospital</a></button></div>
            </div>
    <div class="form">
        <form action="" method="POST">

        <div class="patientSignupBox1">
            <label>Patient name</label>
            <input type="text" name="pname" placeholder="Patient full name"><br>

            <label>Patient email</label>
            <input type="text" name="pemail" placeholder="Patient email"><br>
</div>

            <div class="patientSignupBox2">
            <label>Patient password</label>
            <input type="text" name="ppwd" placeholder="Patient password"><br>

            <label>Patient contact</label>
            <input type="text" name="pcontact" placeholder="Patient contact"><br>
</div>

            <div class="patientSignupBox3">
            <label>Patient address</label>
            <input type="text" name="paddress" placeholder="Patient address"><br>

             <label>Patient address</label>
            <input type="text" name="page" placeholder="Patient age"><br>

</div>

           <div class="patientSignupBox4">
              <label>Patient gender</label>
            <input type="radio" name="pgender" value="Male">Male<br>
            <input type="radio" name="pgender" value="Female">Female<br>

</div>
           

            <button type="submit" class="sampleSignupbtn">Signup</button>
        </form>
</div>
    </div>
</body>

</html>