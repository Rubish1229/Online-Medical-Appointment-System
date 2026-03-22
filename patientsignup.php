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
      <!-- <link rel="stylesheet" href="./part/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./part/patientSignup.css">     -->

    <!-- <link rel="stylesheet" href="./part/sampleSignup.css">     -->


    <link rel="stylesheet" href="./part/sampleSignup.css">
     <link rel="stylesheet" href="./part/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

   
</head>

<style>
  .mainBox{
    background: linear-gradient(to top, #95bcf6, #0D6DFD);
    width: 1100px;
    height: 1060px;
  }
    .form{
        background-color: white;
        height: 870px;
    }
    h2{
        color:white;
    }
    .category button{
        border:2px solid white
    }
    .sampleSignupbtn{
        height: 50px;
        margin-top: 40px;

    }

</style>

<body>
    <?php include 'navbar1.php' ?>
     <div class="signupBox mainBox">
    <h2>Patient's signup form</h2>
    <div class="category">
                <div class="patientCategory cat"> <button style="background-color: #0D6DFD;"><a href="patientsignup.php" style="color: white; "> Patient</a></button></div>
                <div class="doctorCategory cat"><button style="background-color: white;"><a href="samplesignup.php" style="color: black; "> Doctor</a></button></div>
                <div class="hospitalCategory cat"><button><a href="hospitalsignup.php">Hospital</a></button></div>
            </div>
    <div class="form">
        <form action="" method="POST">

        <div class="signupBox1">
            <label class="labelClass">Patient full-name</label>
            <input type="text" name="pname" placeholder="Patient full name" required> <br>

            <label class="labelClass">Patient email</label>
            <input type="email" name="pemail" placeholder="Patient email" required><br>
<!-- </div> -->

            <!-- <div class="patientSignupBox2"> -->
            <label class="labelClass">Patient password</label>
            <input type="text" name="ppwd" placeholder="Patient password" required><br>

            <label>Patient contact</label>
            <input type="tel" id="pcontact" name="pcontact" placeholder="Patient contact"  pattern="9[0-9]{9}"  required><br>
<!-- </div> -->

            <!-- <div class="patientSignupBox3"> -->
            <label>Patient address</label>
            <input type="text" name="paddress" placeholder="Patient address" required> <br>

             <label>Patient age</label>
            <input type="text" name="page" placeholder="Patient age" required><br>

<!-- </div> -->

           <!-- <div class="patientSignupBox4"> -->
              <label>Patient gender</label>
              <div class="gender-group">
                <label for="">
            <input type="radio" name="pgender" value="Male" class="radio-group">Male<br>
            </label>
            <label for="">
            <input type="radio" name="pgender" value="Female" class="radio-group">Female<br>
            </label>
</div>
           

            <button type="submit" class="sampleSignupbtn">Signup</button>
        </form>
</div>
    </div>

  

</body>

</html>