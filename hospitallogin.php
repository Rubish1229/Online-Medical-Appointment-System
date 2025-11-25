


<?php
require 'Connection.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $h_email = $_POST['hemail'];
    $h_pwd = $_POST['hpwd'];

    $sql = "SELECT * FROM hospital WHERE h_email = ? AND h_pwd = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $h_email, $h_pwd);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        echo "Login successful!";
        header("Location: hpatientbooklist.php"); 
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

</style>
<body>
<?php include 'navbar.php' ?>
    <div class="patientSignupBox">
    <div class="category">
                <div class="patientCategory cat"> <button style="background-color: #0D6DFD;"><a href="patientlogin.php" style="color: white; "> Patient</a></button></div>
                <div class="doctorCategory cat"><button style="background-color: white;"><a href="samplelogin.php" style="color: black; "> Doctor</a></button></div>
                <div class="hospitalCategory cat"><button><a href="hospitalsignup.php">Hospital</a></button></div>
            </div>

    <div class="box" style="margin-top: 50px;">
        <div class="leftdiv">
            
                
         
            <div class="leftdiv2 ">
                <img src="./images/hospitalImg.png" alt="doctorimg" class="img1" style="margin-top:125px; margin-left:-30px;">
                
            </div>
            
        
           </div>
        <div class="rightdiv">

            <h1 style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif ;">Login Page</h1>
            <div class="category">
                        <div class="patientCategory cat"><a href="patientlogin.php"> <button>Patient</button></a></div>
                        <div class="doctorCategory cat" ><a href="patientlogin.php"> <button style="background-color:white; color:black;">Doctor</button></a></div>
                        <div class="hospitalCategory cat"><button style="background-color:#0D6DFD; color:white;">Hospital</button></div>
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
                            <input type="text" name="hemail" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="formLogin">
                        <label for="Username">Password</label>
                        <div class="inputBox">
                            <i class="fa-solid fa-key"></i>
                            <input type="text" name="hpwd" placeholder="Enter password">
                        </div>
                    </div>
                    <button class="doctorLogin" id="doctorLogin">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>