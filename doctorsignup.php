<?php

require 'Connection.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $d_name = $_POST['dname'];
    $d_department = $_POST['ddepartment'];
    $d_contact = $_POST['dcontact'];
    $d_address = $_POST['daddress'];
    $d_email = $_POST['demail'];
    $d_pwd = $_POST['dpwd'];
    $d_gender=$_POST['dgender'];
    $d_licensenum = $_POST['dlicensenum'];


    $sql = "INSERT INTO doctor(d_name,d_department,d_contact,d_address,d_email,d_pwd,d_gender,d_licensenum) VALUES (?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($sql);
     $stmt-> bind_param("sssssssi",$d_name,$d_department,$d_contact,$d_address,$d_email,$d_pwd,$d_gender,$d_licensenum);

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
    
</head>

<body>
    <h2>Dcotor signup form</h2>
    <div class="form">
        <form action="" method="POST">
            <label>Hospital name</label>
            <input type="text" name="dname" placeholder="Doctor name"><br>

            <!-- <label>Doctor department</label> create a dropdwn menu for deparment add department form hospital -->
           <label>Select department</label>

<select name="ddepartment" required >
    <option value=""disabled selected hidden>-- Select department --</option>

    <?php
        require 'Connection.php';

        $sql = "SELECT dept_name FROM department";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='".$row['dept_name']."'>".$row['dept_name']."</option>";
            }
        }
    ?>
</select>

            <label>Doctor contact</label>
            <input type="phone" name="dcontact" placeholder="Doctor contact"><br>

            <label>Doctor address</label>
            <input type="text" name="daddress" placeholder="Doctor address"><br>

            <label>Doctor email</label>
            <input type="email" name="demail" placeholder="Doctor email"><br>

            <label>Doctor password</label>
            <input type="password" name="dpwd" placeholder="Doctor password"><br>

            <label>Doctor gender</label>
            <input type="radio" name="dgender" value="Male">Male<br>
            <input type="radio" name="dgender" value="Female">Female<br>

            <label>Doctor license number</label>
            <input type="number" name="dlicensenum" placeholder="Doctor license"><br>

            <button type="submit">Signup</button>
        </form>

    </div>
</body>

</html>