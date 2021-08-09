<?php
include 'db_conn.php';
//session include
include "session.php";
if (isset($_POST['unit'])) {
    $unitcode = array_keys($_POST['unit'])[0];
}
if (isset($_POST['update'])) {
    $description = $_POST["description"];
    $unitcode = $_POST["unit_code"];
    $query = "UPDATE `unit_master` SET `description`='$description' where `unit_code`='$unitcode'";
    $mysqli->query($query);
}
?>
<html>

  <head>
      <title>View Unit Detail</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <meta charset="utf-8">
      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <!-- Link to use icon-->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
      <!-- Popper JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"> </script>
      <link rel="stylesheet" type="text/css" href="css/unitdetail.css">
  </head>

  <body>
      <!-- Nav bar of the page -->
      <nav class="navbar navbar-expand-sm" style="background-color:#051d45;">
          <div class="container">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                  <li class="nav-item active">
                      <a class="nav-link" href="index.php" style="color: white;">Home</a>
                  </li>
                  <?php
  if ($session_user == "") {
      echo "<a class='nav-link' style='color:white' href='register.php'>Register Now</a>";

      echo "
                        <a  class='nav-link btn ' style='color:white' href='sign_in_Form.php'>Login</a>";
  } else {
      echo "<a class='nav-link p-2 mr-auto 'style='color:white' href='signout.php'>Sign out</a>";

      echo "  <div class='container1'>
                        <a class='nav-link p-2 mr-auto' style='color:white' class='nav-link' >" . $session_user . "</a>
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
                  <a class="btn btn-primary" href="Master_unit.php">Unit Management</a>
                  <a class="btn btn-success" href="Master_academic.php">Staff Management</a>
              </div>
          </div>
      </div>
      <!-- End of background page -->
      <!-- Content for the page -->
      <div id="pageContainer">
          <div id="page">

              <div class="contentArea" role="main">
                  <div class="form-box">
                      <form method="post" action="" name="detail">
                          <!-- Select unit detail and staff detail from table `unit_master` and `staff`-->
                          <?php
  $query = "SELECT * FROM `unit_master`,`staff`
                where `unit_master`.`ucid`=`staff`.`staffid`
                and `unit_master`.`unit_code`='$unitcode'";
  $result = $mysqli->query($query);
  while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $unit_code = $row['unit_code'];
      $unit_name = $row['unit_name'];
      $description = $row['description'];
      $uc = $row['username'];?>
                          <h2>Unit Overview</h2>
                          <p>
                              <strong>Unit Title:</strong>
                              <?php echo $unit_name; ?>
                          </p>
                          <p>
                              <strong>Unit Code:</strong>
                              <?php echo $unit_code; ?>
                          </p>
                          <p>
                              <strong>Unit coordinator:</strong>
                              <?php echo $uc; ?>
                          </p>
                          <strong>Unit Description:</strong><br />

                          <textarea id="description" name="description" style="width:80%; height:40%;" disabled>
                  <?php echo $description; ?>
                  </textarea>
                  </div>
                  <!-- Select unit detail and staff detail from table `unit_second` and `staff`-->
                  <?php
  $query1 = "SELECT * FROM `unit_second`,`staff` WHERE `unit_second`.`unit_code`='$unit_code' and `unit_second`.`lecturer_id`=`staff`.`staffid`";
      $result1 = $mysqli->query($query1);
      if ($result1->num_rows == 0) {
          echo "  <p>
                      Unvailable
                    </p>";
      } else {
          echo "<p>Available</p>";
      }
      while ($row1 = $result1->fetch_array(MYSQLI_ASSOC)) {
          $campus = $row1['campus'];
          $semester = $row1['semester'];
          $lecturer = $row1['username'];?>
                  <p>
                      <strong>Unit lecturer:</strong> <?php echo $lecturer; ?>

                      <strong>Campus:</strong>
                      <?php echo $campus; ?>

                      <strong>Offering Semester:</strong>
                      <?php echo $semester; ?>
                  </p>

                  <?php
  }
      echo "<hr />";
  }
  ?>
                  <input type='hidden' name='unit_code' value='<?php echo $unit_code; ?>'>
                  <input type="submit" class="registerbtn" id='update' name='update' value="Submit">
                  <input type="button" class="registerbtn" id='edit' name='edit' value="Edit">
                  </form>

              </div>
          </div>
      </div>
      <!-- Enf of Content-->
      </div>
      <!-- script part -->
      <script>
      $(document).ready(function() {
          $('#update').hide();
          $('#edit').click(function() {
              $('#update').show();
              $('#description').removeAttr('disabled');
          });
      });
      </script>
  </body>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
      integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
      integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>

</html>