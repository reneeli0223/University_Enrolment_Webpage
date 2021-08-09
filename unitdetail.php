<?php
include('db_conn.php');
//session include
include("session.php");
if($session_user==""){
  header('Location:./index.php?error=login_needed');
}
 ?>
<html>

  <head>
    <title>View Unit Detail</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/unitdetail.css">
  </head>

  <body>

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
      <!-- End of nav bar -->
      <!-- background page -->
      <div id="backgroundContainer">
        <div class="text-center background jumbortron">
          <div class="padding">
            <h1 class="display-4">The University of DoWell </h1>
            <p class="display-10">Start Learning from today </p>
            <a class="btn btn-primary" href="unitEnrol.php">Enrol this unit</a>
            <a class="btn btn-success" href="timetable.php">MyTimetable</a>
          </div>
        </div>
      </div>
      <!-- End of background page -->
      <!-- Content for the page -->
      <div id="pageContainer">
        <!--
        <div id="head">
          <div id="headingcontainer">
            <div id="groupName">Study with us</div>
            <div id="pageHeading">

              <h1>Unit title: Web Development</h1>
            </div>
          </div>
        </div>-->
        <div id="page">
          <div class="contentArea" role="main">

            <?php

            $query="SELECT * FROM `unit_master`,`staff` where `unit_master`.`ucid`=`staff`.`staffid`";
            $result=$mysqli->query($query);
            while($row=$result->fetch_array(MYSQLI_ASSOC)){
            $unit_code=$row['unit_code'];
            $unit_name=$row['unit_name'];
            $description=$row['description'];
            $uc=$row['username'];

             ?>
            <h2>Unit Overview</h2>
            <p>
              <strong>Unit Title:</strong>
            <?php echo $unit_name;?>
            </p>
            <p>
              <strong>Unit Code:</strong>
                <?php echo $unit_code;?>
            </p>

            <p>
              <strong>Unit coordinator:</strong>
                 <?php echo $uc;?>
            </p>

            <p>
              <strong>Unit Description</strong>
            </p>
            <p>
                          <?php echo $description;?>
              <!--
              This unit will explain the relationship between data, information and knowledge and introduce a number of different tools
              for managing, storing, securing, modelling, visualizing and analysing data. This unit will provide an understanding of how
              data can be manipulated to meet the information needs of users. This unit introduces the techniques to enable the
              students to use SQL for managing data, creating information and allowing knowledge development.
              This unit provides students with the knowledge, understanding and skills required to develop an application system which
              uses a web interface to a back-end database. The emphasis in the unit is on mastery of the key concepts and the basic
              knowledge and skills required to build this kind of application. The unit will provide students with an awareness of the
              wide range of technologies which are used to support this kind of application, but will examine only a limited number of
              these technologies to demonstrate the key concepts and their application. The unit explores the purposes and approaches
              in using scripting and markup languages in relation to the client-server paradigm. The role of both server-side and clientside code are examined. Students will study the use of markup and scripting programming languages to connect to
              databases via a network.
              Students are introduced to some of the most common security issues involved in the development of software, including
              secure coding practices, secure database access, secure data communications, security of web applications, use of
              encryption techniques and security testing. Students are provided with a range of practical exercises to reinforce their
              skills, including authenticating and authorising users programmatically, user input validation, developing secure web and
              database applications, encrypting and hashing data programmatically, generating digital signatures programmatically,
              security testing, designing logging and auditing mechanisms.

-->
            </p>

<?php
$query1="SELECT * FROM `unit_second`,`staff` WHERE `unit_second`.`unit_code`='$unit_code' and `unit_second`.`lecturer_id`=`staff`.`staffid`";
$result1=$mysqli->query($query1);

if($result1->num_rows==0){

  echo "  <p>
      Unvailable
    </p>";
}else{

  echo "  <p>
      Available
    </p>";
}
while($row1=$result1->fetch_array(MYSQLI_ASSOC)){
  $campus=$row1['campus'];
  $semester=$row1['semester'];
  $lecturer=$row1['username'];

?>
            <p>
              <strong>Unit lecturer:</strong>   <?php echo $lecturer;?>

              <strong>Campus:</strong>
           <?php echo $campus;?>

              <strong>Offering Semester:</strong>
             <?php echo $semester;?>
            </p>

<?php
}
echo "<br /><br /><hr />";
}
?>
<!--
            <p>
              <strong>Unit lecturer:</strong> Dr. Ananda Maiti
            </p>
            <p>
              <strong>Campus:</strong>
              Pandora, Rivendell,Neverland
            </p>
            <p>
              <strong>Offering Semester:</strong>
              Semester 1, Semester 2, Winter School, Spring School
            </p>


            <div class="button">
              <a class="btn btn-primary" href="unitEnrol.php">Enrol this unit</a>
            </div>
                -->
          </div>
        </div>
      </div>
      <!-- Enf of Content-->
      </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

</html>
