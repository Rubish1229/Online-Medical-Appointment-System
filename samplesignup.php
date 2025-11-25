<?php
require 'Connection.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $d_name        = $_POST['dname'];
    $department_id = $_POST['ddepartment'];
    $d_contact     = $_POST['dcontact'];
    $d_address     = $_POST['daddress'];
    $d_email       = $_POST['demail'];
    $d_pwd         = $_POST['dpwd'];
    $d_gender      = $_POST['dgender'];
    $d_licensenum  = $_POST['dlicensenum'];

    // Fetch department name based on department_id
    $depSql = "SELECT dept_name FROM department WHERE dept_id = ?";
    $depStmt = $con->prepare($depSql);
    $depStmt->bind_param("i", $department_id);
    $depStmt->execute();
    $depResult = $depStmt->get_result();
    $depRow = $depResult->fetch_assoc();
    $department_name = $depRow['dept_name'];

    // Insert into sampledoctor table
    $sql = "INSERT INTO sampledoctor(d_name, department_id, department_name, d_contact, d_address, d_email, d_pwd, d_gender, d_licensenum)
            VALUES (?,?,?,?,?,?,?,?,?)";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("sissssssi", $d_name, $department_id, $department_name, $d_contact, $d_address, $d_email, $d_pwd, $d_gender, $d_licensenum);

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
     <link rel="stylesheet" href="./part/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

   
  
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
    <div class="signupBox">
    <h2>Doctor's signup form</h2>
<div class="category">
                <div class="patientCategory cat"> <button><a href="patientsignup.php" > Patient</a></button></div>
                <div class="doctorCategory cat"><button><a href="samplesignup.php" style="color: white;"> Doctor</a></button></div>
                <div class="hospitalCategory cat"><button><a href="hospitalsignup.php">Hospital</a></button></div>
            </div>

    <div class="form">
        <form action="" method="POST">
            <div class="signupBox1">
            <label>Doctor name</label>
            <input type="text" name="dname" placeholder="Doctor name"><br>

            <!-- <label>Doctor department</label> create a dropdwn menu for deparment add department form hospital -->
           <label>Select department</label>

<select name="ddepartment" required >
    <option value=""disabled selected hidden>-- Select department --</option>

    <?php
        require 'Connection.php';

        $sql = "SELECT dept_id,dept_name FROM department";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='".$row['dept_id']."'>".$row['dept_name']."</option>";
            }
        }
    ?>
</select>
</div>

            <div class="signupBox2">
            <label>Doctor contact</label>
            <input type="phone" name="dcontact" placeholder="Doctor contact"><br>

            <label>Doctor address</label>
            <input type="text" name="daddress" placeholder="Doctor address"><br>
            </div>

             <div class="signupBox3">
            <label>Doctor email</label>
            <input type="email" name="demail" placeholder="Doctor email"><br>

           
            <label>Doctor password</label>
            <input type="password" name="dpwd" placeholder="Doctor password"><br>
  </div>
  <div class="signupBox4">
            <label>Doctor gender</label>
            <input type="radio" name="dgender" value="Male">Male<br>
            <input type="radio" name="dgender" value="Female">Female<br>
  

            <label>Doctor license number</label>
            <input type="number" name="dlicensenum" placeholder="Doctor license"><br>
    </div>
            <button type="submit" class="sampleSignupbtn">Signup</button>
        </form>

    </div>
    </div>
</body>

</html>