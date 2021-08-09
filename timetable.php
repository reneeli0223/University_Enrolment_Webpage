<?php
include('db_conn.php');
//session include
include("session.php");
if($session_user==""){
    header('Location:./index.php?error=login_needed');
  }
  
  $query="SELECT * FROM `students` WHERE `username`='$session_user'";
  $result=$mysqli->query($query);
  $row=$result->fetch_array(MYSQLI_ASSOC);
  $studentid=$row['studentid'];
  $_SESSION['session_userid']=$studentid;
   ?>
<html>

<head>
    <title>View your timetable</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/timetable.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<body>
    <!-- Nav bar of the page -->
    <nav class="navbar navbar-expand-sm" style="background-color:#051d45;">
        <div class="container">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php" style="color: white;">Home</a>
                </li>
                <?php
            if($session_user==""){
              echo "<a class='nav-link' style='color:white' href='register.php'>Register Now</a>";

              echo "
                    <a  class='nav-link btn ' style='color:white' href='sign_in_Form.php'>Login</a>";
            }else{

              echo "<a class='nav-link p-2 mr-auto 'style='color:white' href='signout.php'>Sign out</a>";


              echo "  <div class='container1'>
                    <a class='nav-link p-2 mr-auto' style='color:white' class='nav-link' >".$session_user."</a>
                  </div>";
            }
            ?>
            </ul>
        </div>
        </div>
    </nav>
    <!-- End of Nav bar -->
    <!-- start of the background container-->
    <div id="backgroundContainer">
        <div class="text-center background jumbortron">
            <div class="padding">
                <h1 class="display-4">The University of DoWell </h1>
                <p class="display-10">Start Learning from today </p>
                <a class="btn btn-primary" href="unitEnrol.php">Unit Enrolment</a>
                <a class="btn btn-success" href="allocation.php">Tutorial allocation</a>
            </div>
        </div>
    </div>
    <!-- End of the background container-->
    <!-- profile bar -->

    <div class="chooseTimetable">
        <div class="profilebar" id="profile">
            <div class="module">
                <div class="profileinfo">
                    <p>
                        Student Name:
                        <?php
          $query1="SELECT * FROM `students`where `students`.`studentid`='$studentid'";
          $result1= mysqli_query($mysqli, $query1);
          $resultCheck1 = mysqli_num_rows($result1);
          if ($resultCheck1 > 0) {
            while ($row1 = mysqli_fetch_assoc($result1)){
              echo $row1['username'];
            }
          }?>
                    </p>
                    <p>
                        Email Address:
                        <?php
        $query1="SELECT * FROM `students`where `students`.`studentid`='$studentid'";
        $result1= mysqli_query($mysqli, $query1);
        $resultCheck1 = mysqli_num_rows($result1);
        if ($resultCheck1 > 0) {
          while ($row1 = mysqli_fetch_assoc($result1)){
          echo $row1['email'];
        }
      }?>
                    </p>
                </div>
                <!-- end of profile bar -->

                <div class="timetableChoose" id="timetableChoose">
                    <div class="container">
                        <div class="row justify-content-md-center">
                            <div class="col-md-auto">
                                <!-- table start -->
                                <table class='table'>
                                    <thead>
                                        <tr>
                                            <th>Unit Code</th>
                                            <th>Lecture</th>
                                            <th>Tutorial</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- select enrol unit lecture and tutorial info from database -->
                                        <?php 
                                        $query2="SELECT * FROM `enrol`,`unit_second`,`lecture`,`tutorial`
                                        where `enrol`.`unit_id`=`unit_second`.`unit_id`
                                        and `lecture`.`unit_id`=`enrol`.`unit_id`
                                        and `tutorial`.`tutorial_id`=`enrol`.`tutorial_id`
                                        and `enrol`.`student_id`='$session_userid'";

                                        $result2=mysqli_query($mysqli,$query2);
                                        $resultCheck2= mysqli_num_rows($result2);
                                        if($resultCheck2 > 0){
                                            while($row2=mysqli_fetch_assoc($result2)){
                                                echo "
                                                        <tr>
                                                            <td>".$row2['unit_code']."</td>
                                                            <td>".$row2['lecture_time']."</td>
                                                            <td>".$row2['time']."</td>

                                                        </tr>
                                                        ";
                                            }
                                        }    
                                        
                                     ?>
                                </table>
                                <!-- table end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>
<!-- script part : jquery and bootstrap-->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>

</html>