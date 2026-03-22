<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="home.css">
  <!-- <link rel="stylesheet" href="utility.css"> -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">

  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->




</head>

<style>
  *{
    font-family: TImes 'Times New Roman', Times, serif;
  }
  h4 {

    margin-top: 5px;

  }

  .borderline {
    color: #1877F2;
    text-align: center;
  }

  .i-div:hover {
    color: white;
  }
  .list{
    font-size: 18px;
    
  }
  .list1 ul li {
    margin-bottom: 10px;
  }
  .lastpart{
    margin-top: 120px;
    padding-top: 40px;
    padding-left: 80px;
  }
  .i-color{
    color: white;
    font-size: 20px;
  }
</style>

<body>
  <?php include 'navbar1.php';  ?>

  <div class="div1">
    <div class="img1">

      <div class="paragraphs">
        <p class="p1">Discover the SWASTHYA</p>

        <p class="p2">"Book Smarter, Not Harder – Your appointment is just a click away!"</p>

      </div>

      <div class="get-started">

        <button type="button" class="btn btn-primary"><a href="samplesignup.php">Get started</a> </button>
      </div>
    </div>

  </div>

  <div class="steps">
    <div class="steps-div">
      <span>
        <h3>Access healthcare service anytime from anywhere with SWASTHYA </h3>
        <p style="font-size: 18px;">Please follow these steps</p>
      </span>
      <div class="box">
        <div class="main-div">
          <div class="steps-div1">

            <div class="one">
              <h4>1</h4>
            </div>
            <div class="icon1"> <i class="fa-regular fa-user"></i></div>

          </div>
          <div class="line1"></div>
          <div class="desc">
            <h4 style="font-size: 18px;">Sign-up / Login</h4>
          </div>
        </div>


        <div class="main-div">
          <div class="steps-div1">

            <div class="one">
              <h4>2</h4>
            </div>
            <div class="icon1"> <i class="fa-regular fa-hospital"></i></div>

          </div>
          <div class="line1"></div>
          <div class="desc">
            <h4 style="font-size: 18px;">Select department</h4>
          </div>
        </div>


        <div class="main-div2">
          <div class="steps-div1">

            <div class="one">
              <h4>3</h4>
            </div>
            <div class="icon1"> <i class="fa-solid fa-people-line"></i></div>

          </div>
          <div class="line1"></div>
          <div class="desc">
            <h4 style="font-size: 18px;">Select doctor</h4>
          </div>
        </div>


        <div class="main-div2">
          <div class="steps-div1">

            <div class="one">
              <h4>4</h4>
            </div>
            <div class="icon1"> <i class="fa-regular fa-calendar-days"></i></div>

          </div>
          <div class="line1"></div>
          <div class="desc">
            <h4 style="font-size: 18px;">Book an appointment</h4>
          </div>
        </div>


      </div>
    </div>

  </div>
  </div>


  <div class="departments">
    <div class="departmentfirst ">
      <h2>Departments <br>
        <p style="font-size: 18px; font-weight: normal; margin-top: 5px; color:gray;">Identify and treat your symptoms instantly</p>
      </h2>
      <a href="" class="borderline">View more</a>
    </div>
    <div class="departmentsecond ">
      <ul>
        <li><a href="#"><i class="fa-solid fa-ear-listen"></i><span>ENT</span></a></li>
        <li><a href="#"><i class="fa-solid fa-eye"></i><span class="para">Eye</span></a></li>
        <li><a href="#"><i class="fa-solid fa-dna"></i><span>Gastrology</span></a></li>
        <li><a href="#"><i class="fa-solid fa-tooth"></i><span>Dentistry</span></a></li>
        <li><a href="#"><i class="fa-solid fa-user-md"></i><span>Dermatology</span></a></li>
        <li><a href="#"><i class="fa-solid fa-heart-pulse"></i><span>Cardiology</span></a></li>
        <li><a href="#"><i class="fa-solid fa-brain"></i><span>Neurology</span></a></li>
        <li><a href="#"><i class="fa-solid fa-bone"></i><span>Orthopedics</span></a></li>
        <li><a href="#"><i class="fa-solid fa-child"></i><span>Pediatrics</span></a></li>
        <li><a href="#"><i class="fa-solid fa-syringe"></i><span>Immunology</span></a></li>
        <li><a href="#"><i class="fa-solid fa-baby"></i><span>Gynecology</span></a></li>
        <li><a href="#"><i class="fa-solid fa-lungs"></i><span>Pulmonology</span></a></li>
      </ul>
    </div>
  </div>




  <div class="doctor-section">
    <div class="doctorfirst">
      <h2>Hospitals<br>
        <p style="font-size: 18px; font-weight: normal; margin-top: 5px;">Experienced medical practitioners available here.</p>
      </h2>
      <a href="" class="borderline">View more</a>
    </div>
    <div class="slider-container">
      <button class="slide-btn left-btn" id="left-btn"><i class="fa-solid fa-chevron-left"></i></button>

      <div class="doctor-slider" id="doctor-slider">
        <div class="doctor-card">
          <img src="https://ghealth121.com/wp-content/uploads/2020/08/National-Medicare-Hospital-Research-Centre.jpg" alt="Dr. Raju Pangeni">
          <h5>Medicare Hospital</h5>
          <p>Chabahil</p>

          <button class="book-btn">See more</button>
        </div>
        <div class="doctor-card">
          <img src="https://the-corporate.com/public/profile_images/22750-1620390153.jpg" alt="Dr. Raju Pangeni">
          <h5>Om Hospital</h5>
          <p>Chabahil</p>

          <button class="book-btn">See more</button>
        </div>
        <div class="doctor-card">
          <img src="https://hamshospital.com/wp-content/uploads/2022/09/hams-hsopital-photo.jpg" alt="Dr. Raju Pangeni">
          <h5>HAMS Hospital</h5>
          <p>Dhumbarai</p>

          <button class="book-btn">See more</button>
        </div>
        <div class="doctor-card">
          <img src="https://assets.rumsan.net/clients/recordnepal/bir-hospital.jpg" alt="Dr. Raju Pangeni">
          <h5>Bir Hospital</h5>
          <p>New road</p>

          <button class="book-btn">See more</button>
        </div>
        <div class="doctor-card">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTfoLAqAu7XfWoy9EVhyfKXega6povsQ5fGLg&s" alt="Dr. Raju Pangeni">
          <h5>Mediciti Hospital</h5>
          <p>Kathmandu</p>

          <button class="book-btn">See more</button>
        </div>
        <div class="doctor-card">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR-VEpagImIkVSyzyay672kWapfbr4PIOpfRQ&s" alt="Dr. Raju Pangeni">
          <h5>Kanti Children's Hospital/h5>
          <p>Karyabinayak, Lalitpur</p>

          <button class="book-btn">See more</button>
        </div>


      </div>




      <button class="slide-btn right-btn" id="right-btn"><i class="fa-solid fa-chevron-right"></i></button>
    </div>
  </div>







  <div class="doctor-section">
    <div class="doctorfirst">
      <h2>Appointments With Top Doctors <br>
        <p style="font-size: 18px; font-weight: normal; margin-top: 5px;">Experienced medical practitioners available here.</p>
      </h2>
      <a href="" class="borderline">View more</a>
    </div>
    <div class="slider-container">
      <button class="slide-btn left-btn"><i class="fa-solid fa-chevron-left"></i></button>

      <div class="doctor-slider">
        <div class="doctor-card">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRCU36Wgp90Zo3KbwVNVqrL0anzRg2xMM5lcJwRh-jyTBxMIvviqLCoJJttCC1sTQG4jto&usqp=CAU" alt="Dr. Raju Pangeni">
          <h5>Dr. Kumar Shrestha</h5>
          <p>Pulmonologist</p>

          <button class="book-btn">See more</button>
        </div>
        <div class="doctor-card">
          <img src="https://media.istockphoto.com/id/1468678624/photo/nurse-hospital-employee-and-portrait-of-black-man-in-a-healthcare-wellness-and-clinic-feeling.jpg?s=612x612&w=0&k=20&c=AGQPyeEitUPVm3ud_h5_yVX4NKY9mVyXbFf50ZIEtQI=" alt="Dr. Raju Pangeni">
          <h5>Dr. Raju Pangeni</h5>
          <p>Neurologist</p>

          <button class="book-btn">See more</button>
        </div>
        <div class="doctor-card">
          <img src="https://static.vecteezy.com/system/resources/thumbnails/026/375/249/small/ai-generative-portrait-of-confident-male-doctor-in-white-coat-and-stethoscope-standing-with-arms-crossed-and-looking-at-camera-photo.jpg" alt="Dr. Raju Pangeni">
          <h5>Dr. Keshav Dahal</h5>
          <p>ENT</p>

          <button class="book-btn">See more</button>
        </div>
        <div class="doctor-card">
          <img src="https://images.rawpixel.com/image_800/cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDIzLTA4L3Jhd3BpeGVsb2ZmaWNlMV9waG90b2dyYXBoeV9vZl9hbl9zb3V0aF9pbmRpYW5fd29tZW5fYXNfYV9kb2N0b19kMzAxMDM3Zi03MDUzLTQxNDAtYmYyZS1lZDFlYWE0YTM3NDRfMS5qcGc.jpg" alt="Dr. Raju Pangeni">
          <h5>Dr. Ranjita Karki</h5>
          <p>Dermatology</p>

          <button class="book-btn">See more</button>
        </div>
        <div class="doctor-card">
          <img src="https://media.istockphoto.com/id/1372002650/photo/cropped-portrait-of-an-attractive-young-female-doctor-standing-with-her-arms-folded-in-the.jpg?s=612x612&w=0&k=20&c=o1QtStNsowOU0HSof6xQ_jZMglU8ZK565gHd655U6S4=" alt="Dr. Raju Pangeni">
          <h5>Dr. Sita NEpal</h5>
          <p>Pulmonologist</p>

          <button class="book-btn">See more</button>
        </div>
        <div class="doctor-card">
          <img src="https://images.pexels.com/photos/19596247/pexels-photo-19596247/free-photo-of-portrait-of-smiling-black-woman-doctor-in-medical-robe.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Dr. Raju Pangeni">
          <h5>Dr. Anjali Shakya</h5>
          <p>Dentistry</p>

          <button class="book-btn">See more</button>
        </div>


      </div>


      <button class="slide-btn right-btn"><i class="fa-solid fa-chevron-right"></i></button>
    </div>
  </div>



  <div class="healthpackage-section">
    <div class="healthfirst">
      <h2>Health Packages<br>
        <p style="font-size: 18px; font-weight: normal; margin-top: 5px; color:gray;">Offering complete checkups, accurate diagnostics, and personalized care at affordable prices.</p>
      </h2>
      <a href="" class="borderline">View more</i></a>
    </div>

    <section class="package-section">
      <div class="package-grid">
        <div class="package-item large">
          <img src="./images/package.png" alt="">
          <div class="price-tag">Package from:<br><strong>Rs. 5000</strong></div>
        </div>

        <div class="right-grid">
          <div class="package-item small">
            <img src="https://images.pexels.com/photos/3825529/pexels-photo-3825529.jpeg" alt="">
            <div class="price-tag">Package from:<br><strong>Rs. 500</strong></div>
          </div>

          <div class="bottom-row">
            <div class="package-item small">
              <img src="https://sunrisediagnosis.com/wp-content/uploads/2025/06/best-health-check-up-packages-559x559.jpg" alt="">
              <div class="price-tag">Package from:<br><strong>Rs. 100</strong></div>
            </div>
            <div class="package-item small">
              <img src="https://medpics.com/blog/upload/1594651328_blog.jpg" alt="">
              <div class="price-tag">Package from:<br><strong>Rs. 200</strong></div>
            </div>
          </div>
        </div>
      </div>

      <div class="overlay">
        <a href="FindHealhPackages.php">
        <button class="view-btn">View more</button>
        </a>
      </div>
    </section>
  </div>


  <div class="about">
    <div class="about1 all" id="about1">
      <p>What is SWASTHYA?</p>
    </div>
    <div class="about2 all" id="about2">
      <p>How do I book?</p>
    </div>
    <div class="about1 all" id="about3">
      <p>What are the features available?</p>
    </div>
    <div class="about1 all" id="about4">
      <p>How to cancel?</p>
    </div>
    <div class="about1 all" id="about5">
      <p>How do I pay?</p>
    </div>
    <div class="about1 all" id="about6">
      <p>Is it safe?</p>
    </div>
  </div>

  <div class="lastpart">
    <div class="list list1">
      <ul>
        <li><a href="">
            <h4><u>QUICK LOGIN</u></h4>
          </a></li>
        <li><a href=""> Patient </a></li>
        <li><a href=""> Doctor </a></li>
        <li><a href=""> Hospital </a></li>
      </ul>
    </div>

    <div class="list2 list list1">
      <ul>
        <li><a href="">
            <h4><u>QUICK LINKS</u></h4>
          </a></li>
        <li><a href=""> Departments </a></li>
        <li><a href=""> Hospitals </a></li>
        <li><a href=""> Doctors </a></li>
        <li><a href=""> Health packages </a></li>
      </ul>
    </div>

    <div class="list3 list list1">
      <ul>
        <li><a href="">
            <h4><u>GET IN TOUCH</u></h4>
          </a></li>
        <li><a href=""> <i class="fa-solid fa-location-dot fa-beat-fade i-color"></i> &nbsp Chabahil, Kathmandu </a></li>
        <li><a href=""><i class="fa-solid fa-phone fa-shake i-color"> &nbsp</i>+977-9876542314 </a></li>
        <li><a href=""> <i class="fa-solid fa-envelope fa-bounce i-color"></i>&nbsp digitalswasthya@gmail.com </a></li>
      </ul>
    </div>


    <div class="list4 list list1">
      <ul>
        <li><a href="">
            <h4><u>FOLLOW US ON</u></h4>
          </a></li>
      </ul>

      <div class="social-icons">
        <span><a href="http://facebook.com/" class="social" style="color: #1877F2; margin-left:-30px;"><i class="fa-brands fa-facebook"></i></a></span>
        <span><a href="https://www.instagram.com/" class="social"><i class="fa-brands fa-instagram"></i></a></span>
        <span><a href="https://x.com/" class="social" style="color: black;"><i class="fa-brands fa-x-twitter"></i></a></span>
      </div>


    </div>



    <script src="script.js"></script>
    <script src="about.js"></script>

</body>

</html>