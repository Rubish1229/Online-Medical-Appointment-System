<?php
session_start();
require 'Connection.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['demail'];
    $pwd = $_POST['dpwd'];

    $sql = "SELECT * FROM sampledoctor WHERE d_email = ? AND d_pwd = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $email, $pwd);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
          $doctor = $result->fetch_assoc();
        $_SESSION['doctor_id'] = $doctor['d_id'];
        $_SESSION['doctor_name'] = $doctor['d_name'];
        header("Location: doctorpatientbooklist.php");
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
      <!-- <link rel="stylesheet" href="home.css"> -->
    <link rel="stylesheet" href="utility.css">
    <link rel="stylesheet" href="./part/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<style>
    
.navbar{
    height: 8.2vh;
    width: 100%;
    border-bottom: 1px  solid black;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px;
    box-sizing: border-box;
     box-shadow: 0px 5px 15px gray;
     
     
     

    
    
}
nav{
    position: fixed;
     z-index: 10;
     top: 0;
     margin: 0;
       height: 8.3vh;
  width: 100%;
  background-color: white;
  
    
    }


.logo img{
    height: 57px;
    width: 68px;
    margin-top: 2px;
    margin-left: 5px;
    cursor: pointer;
}


.nav-list ul{
    list-style: none;
    display: flex;
    /* gap: -30px; */
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
    
   
    
}
i{
    font-size: 13px;
    margin-bottom: 7px;
        color: #0D6DFD;

}

.nav-list ul li a{
    color: black;
    text-decoration: none;
    font-weight: 400;
   
    
}
.nav-list ul li :hover{
    color: #0D6DFD;
    transition: all 1s ease;
 
    /* font-weight: bold; */
    
   
    
}

.i-login{
    display: flex;
    align-items: center;
    gap: 14px;
    font-size: 15px;
    margin-top: 15px;
      
}
.i-signup{
    display: flex;
    align-items: center;
    gap: 6px;
    border: 2px solid #0D6DFD;
    margin-right: 35px;
    margin-top: 0px;
    padding-top: 8px;
    padding-left: 7px;
    height: 35px;
    width: 100px;

      

}


.signup{
    background-color: white;
    transition: all 0.5s ease;
    border-radius: 5px;
    
}
.signup:hover{
   background-color: #e8edf4;
   color: white;
   border-radius: 12px;
}.login:hover{
  background-color: rgb(255, 218, 218);
   color: white;
   border-radius: 10px;
}
.p-login {
margin-top: 10px;


}
.p-signup {
margin-top: -5px;
padding: 2px ;
font-size: 15px;
color: #0D6DFD;
font-weight: bold;
}


</style>
<body>
<?php include 'navbar.php' ?>

    <div class="box">
        <div class="leftdiv">



            <div class="leftdiv2">
                <img src="./images/doctors.png" alt="doctorimg" class="img1">

            </div>


        </div>
        <div class="rightdiv">

            <h1 style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif ;">Doctor's Login Page</h1>
            <div class="category">
                <div class="patientCategory cat"> <a href="patientlogin.php"><button>Patient</button></a> </div>
                <div class="doctorCategory cat"><a href="samplelogin.php"><button>Doctor</button></a> </div>
                <div class="hospitalCategory cat"><a href="hospitallogin.php"> <button>Hospital</button></a></div>
            </div>

            <div class="doctorAvatar">
                <i class="fa-solid fa-user-doctor"></i>
            </div>


            <div class="form">
                <form action="" method="POST">

                    <div class="formLogin">

                        <div class="formLogin">
                            <label for="Email">Email</label>
                            <div class="inputBox">
                                <i class="fa-regular fa-envelope"></i>
                                <input type="text" name="demail" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="formLogin">
                            <label for="Password">Password</label>
                            <div class="inputBox">
                                <i class="fa-solid fa-key"></i>
                                <input type="password" name="dpwd" placeholder="Enter password">
                            </div>
                        </div>
                        <button class="doctorLogin" id="doctorLogin">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>