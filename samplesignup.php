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
    $sql = "INSERT INTO sampledoctor(d_name, department_id, d_contact, d_address, d_email, d_pwd, d_gender, d_licensenum)
            VALUES (?,?,?,?,?,?,?,?)";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("sisssssi", $d_name, $department_id, $d_contact, $d_address, $d_email, $d_pwd, $d_gender, $d_licensenum);

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
  .mainBox{
    background: linear-gradient(to top, #95bcf6, #0D6DFD);
    width: 1100px;
  }
    .form{
        background-color: white;
    }
    h2{
        color:white;
    }
    .category button{
        border:2px solid white;
    }

    
</style>

<body>
    <?php include 'navbar1.php' ?>
    <div class="signupBox mainBox">
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
<!-- </div> -->

            <!-- <div class="signupBox2"> -->
            <label>Doctor contact</label>
            <input type="tel" name="dcontact" placeholder="Doctor contact" pattern="9[0-9]{9}" required><br>

            <label>Doctor address</label>
            <input type="text" name="daddress" placeholder="Doctor address"><br>
            <!-- </div> -->

             <!-- <div class="signupBox3"> -->
            <label>Doctor email</label>
            <input type="email" name="demail" placeholder="Doctor email"><br>

           
            <label>Doctor password</label>
            <input type="password" name="dpwd" placeholder="Doctor password"><br>
  <!-- </div> -->
  <!-- <div class="signupBox4"> -->

            <!-- <label>Doctor gender</label>
            
            <input type="radio" name="dgender" value="Male">Male<br>
            <input type="radio" name="dgender" value="Female">Female<br> -->
  
            <label>Doctor gender</label>

<div class="gender-group">
    <label>
        <input type="radio" name="dgender" value="Male"> Male
    </label>

    <label>
        <input type="radio" name="dgender" value="Female"> Female
    </label>
</div>



            <label>Doctor license number</label>
            <input type="number" name="dlicensenum" placeholder="Doctor license"><br>
    </div>
            <button type="submit" class="sampleSignupbtn">Signup</button>
        </form>

    </div>
    </div>
</body>

</html>