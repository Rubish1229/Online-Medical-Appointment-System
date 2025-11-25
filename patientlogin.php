


<?php

session_start();
require 'Connection.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $p_email = $_POST['pemail'];
    $p_pwd = $_POST['ppwd'];

    $sql = "SELECT * FROM patient WHERE p_email = ? AND p_pwd = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $p_email, $p_pwd);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
       $row = $result->fetch_assoc();
    $_SESSION['p_id'] = $row['p_id'];   // SAVE SESSION

    header("Location: pbook.php");
    exit(); 
    } else {
        echo "Invalid email or password!";
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
</head>
<style>
    .patientImage img{
        
        margin-right: 200px;
        
    }
</style>
<body>
    <?php include 'navbar.php' ?>
    <br>
    <br>
    <br>
    
    <div class="patientSignupBox" style="margin-top: 20px;">
   

    <div class="box" style="margin-top: 50px;">
        <div class="leftdiv">
            
                
         
            <div class="leftdiv2 patientImage">
                <img src="./images/patientsignup.png" style="height:294px; margin-right:100px; margin-left:-147px; margin-top:100px;" alt="doctorimg" class="img1">
                
            </div>
            
        
           </div>
        <div class="rightdiv">

            <h1 style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif ;">Patient Login Page</h1>
            <div class="category">
                        <div class="patientCategory cat"> <a href="patientlogin.php"><button style="background-color: #0D6DFD; color:white">Patient</button></a></div>
                        <div class="doctorCategory cat" ><a href="samplelogin.php"><button style="background-color: white; color:black">Doctor</button></a></div>
                        <div class="hospitalCategory cat"><button>Hospital</button></div>
                    </div>
            
            <div class="doctorAvatar">
                <i class="fa-solid fa-user-doctor"></i>
            </div>
            

            <div class="form">
                <form action="" method="POST">
                    
                    <div class="formLogin">
                        
                    <div class="formLogin">
                        <label for="Username">Email</label>
                        <div class="inputBox">
                            <i class="fa-regular fa-envelope"></i>
                            <input type="text" name="pemail" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="formLogin">
                        <label for="Username">Password</label>
                        <div class="inputBox">
                            <i class="fa-solid fa-key"></i>
                            <input type="password" name="ppwd" placeholder="Enter password">
                        </div>
                    </div>
                    <button class="doctorLogin" id="patientLogin">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>