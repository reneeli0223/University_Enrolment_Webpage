<!-- php part for the connection and session -->
<?php
include("session.php");
include("db_conn.php");
if(isset($_GET['error'])){
  if($_GET['error']=='login_needed'){
    echo "<script>alert('login is required');</script>";
  }
}
 ?>
<html>
  <head>
    <title>
      Welcome to the homepage of UDW
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta charset="utf-8">
     <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Link to use icon-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Css style for this page -->
    <style>
      .whitecolor {
        color: white;
        font-family: 'Rubik', sans-serif;
        font-weight: bold;
      }

      .background {
        height: 280px;
        background-image: url(img/img1.jpg);
      }

      .padding {
        padding-top: 50px;
      }
    </style>
    <!-- End of css style -->
  </head>
  <body>
    <!-- Nav bar of the page -->
    <nav class="navbar navbar-expand-sm" style="background-color:#051d45;">
      <div class="container">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="" style="color: white;">Home</a>
            </li>
              <?php
            if($session_user==""){
              echo "<a class='nav-link' style='color:white' href='register.php'>Register Now</a>";

              echo "
                    <a  class='nav-link btn' style='color:white' href='sign_in_Form.php'>Login</a>";
            }else{

              echo "<a class='nav-link p-2 mr-auto 'style='color:white' href='signout.php'>Sign out</a>";


              echo "  <div class='container1'>
                    <a class='nav-link p-2 mr-auto' style='color:white' class='nav-link' href='account.php'>".$session_user."</a>
                  </div>";
            }
            ?>
          </ul>
            </div>
        </div>
    </nav>
    <!-- End of nav bar -->
    <!-- background part -->
    <div class="text-center background jumbortron">
      <div class="padding">
        <h1 class="display-4">The University of DoWell </h1>
        <p class="display-10">Start Learning from today </p>
       
        <!-- Different session role will display different page -->
        <?php
        if($session_role==0){

          echo    ' <a class="btn btn-primary" href="./unitdetail.php">Unit Details</a>
                    <a class="btn btn-success" href="./timetable.php">MyTimetable</a>';
  
        }
        if($session_role==1){

          echo    '<a class="btn btn-success" href="./Master_unit.php">Unit management</a>
                  <a class="btn btn-success" href="./Master_academic.php">Staff Management</a>
                  <a class="btn btn-success" href="./editTutorial.php">Tutorial Management</a>
                  <a class="btn btn-success" href="./EnrolledStudents_DC.php">Enrolled Students</a>';

        }
        if($session_role==2){

          echo    '<a class="btn btn-success" href="./Master_academic.php">Staff Management</a>
                   <a class="btn btn-success" href="./editTutorial.php">Tutorial Management</a>
                   <a class="btn btn-success" href="./EnrolledStudents_DC.php">Enrolled Students</a>';

        }
        
        if($session_role==3){

          echo    ' 
                    <a class="btn btn-success" href="./EnrolledStudents_Lec.php">Enrolled Students</a>';

        }
        if($session_role==4){

          echo    ' 
                    <a class="btn btn-success" href="./EnrolledStudents_Tut.php">Enrolled Students</a>';

        }
      ?>
      </div>
    </div>
    <div class="container padding">
      <div class="row">
        <div class="col-sm-4 col-xl-4 ">
          <div class="card">
            <img class="card-img-top " src="img/study.jpg">
            <div class="card-body">
            
              <h4 class="card-title">Unit Enrolment</h4>
              <p class="card-text">Everything you need about courses and fees; how to get started through to enrolments and transcript requests.</p>
              <a href="unitEnrol.php" class="btn btn-outline-success">More Details</a>

            </div>
          </div>
        </div>
        <!-- Card list of three options -->
        <div class="col-sm-4 col-xl-4 ">
          <div class="card">
            <img class="card-img-top" src="img/study2.jpg">
            <div class="card-body">
              <h4 class="card-title">Tutorial Allocation</h4>
              <p class="card-text">Access your tutorial classes, choose your prefered subjects and click following button to know more details.</p>
              <a href="allocation.php" class="btn btn-outline-success">More Details</a>
            </div>
          </div>
        </div>
        <div class="col-sm-4 col-xl-4 ">
          <div class="card">
            <img class="card-img-top" src="img/timetable.jpg">
            <div class="card-body">
              <h4 class="card-title">MyTimetable</h4>
              <p class="card-text">Choose your prefered timetable time and learn more about your timetable.Clike following button to know more details. </p>
              <a href="./timetable.php" class="btn btn-outline-success">More Details</a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </body>
  <!-- script for bootstrap and jquery -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

</html>
