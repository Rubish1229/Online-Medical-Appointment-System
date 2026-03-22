 
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css"
  >
  <link rel="stylesheet" href="css/navbar.css">
 </head>

 <style>
    .i-signuplogin{
        border: 2px solid #0D6DFD;
    }
    .p-signup{
        padding-top: 5px;
    }
 </style>
 <body>

 <nav>
     <div class="navbar">
       <div class="logo">
                 <a href="">
                     <img src="./images/SWASTHYA.png" alt="logo"></a>
             </div>

         <div class="nav-list">
             <ul>
                 <li><a href="FindDoctors.php"> &nbsp Find <br>doctors</a> </li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                 <li><a href="FindDepartments.php"> &nbsp &nbsp &nbsp Find <br>departments</a></li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                 <li><a href="FindHospitals.php"> &nbsp&nbsp Find <br>hospitals</a></li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                 <!-- <li><a href="FindHealhPackages.php"> &nbsp Health <br>packages</a></li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp -->
                 <!-- <li><a href="./part/login.html" class="i-login login"> <i class="fa-regular fa-user"></i><p class="p-login">LOGIN</p></a></li> -->
                 <a href="patientlogin.php" class="i-signuplogin"> <i class="fa-regular fa-user"></i>
                         <p class="p-signup" >LOGIN</p>
                     </a>
                 <a href="patientsignup.php" class="i-signuplogin"> <i class="fa-solid fa-arrow-right-to-bracket"></i>
                         <p class="p-signup">SIGN-UP</p>
                     </a>


             </ul>
         </div>
     </div>
 </nav>

  </body>
 </html>