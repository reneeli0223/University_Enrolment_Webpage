<?php
include('db_conn.php');
include('session.php');
// Select students' information from table students
$query="SELECT * FROM `students` WHERE `username`='$session_user'";
$result=$mysqli->query($query);
$row=$result->fetch_array(MYSQLI_ASSOC);
$studentid=$row['studentid'];

// Select staff information from table students
$queryStaff="SELECT * FROM `staff` WHERE `username`='$session_user'";
$resultStaff=$mysqli->query($queryStaff);
$rowStaff=$resultStaff->fetch_array(MYSQLI_ASSOC);
$staffid=$rowStaff['staffid'];

// Update information after click submit button
if(isset($_POST['update'])){
  $username=$_POST["username"];
  $email=$_POST["email"];
  $address=$_POST["address"];
  $birth=$_POST["birth"];
  $phone=$_POST["phone"];
  $id=$_POST["studentid"];

  $access=0;
  $hashed_password = crypt( $password);
  $query="SELECT `studentid` FROM `students`  WHERE `studentid` LIKE '$id'";
  $result=$mysqli -> query($query1);
  $result_cnt = $result->num_rows;

  if($result_cnt!=0){
    echo "<script> alert ('Userid Exist');</script>";
  }else{
    $query2="UPDATE `students` SET `username`='$username',`email`='$email',`address`='$address',`birth`='$birth',`phone`='$phone' where `username`='$session_user' ";
    $mysqli -> query($query2);
    $mysqli->error;
    $session_user=$username;
    $_SESSION['session_user']=$session_user;
    $session_role=0;
		$_SESSION['session_role']=$session_role;
   header('Location:index.php');
  }
}

?>

<html>

<head>
    <title>
        Welcome to the account page
    </title>
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
    <link rel="stylesheet" type="text/css" href="css/account.css">
    <script src="jquery.tabledit.js"></script>
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
    </nav>
    <!-- student id -->
    <div class="register">
        <div class="form-box">
            <form id="student" class="input-group" method="post" action="" onsubmit="return validatestu();"
                name="registration">
                <input type="text" class="input-field" id="studentid" name="studentid" disabled placeholder="Student ID"
                    value='<?php
          $query1="SELECT * FROM `students`where `students`.`studentid`='$studentid'";
          $result1= mysqli_query($mysqli, $query1);
          $resultCheck1 = mysqli_num_rows($result1);
          if ($resultCheck1 > 0) {
            while ($row1 = mysqli_fetch_assoc($result1)){
             echo $row1['studentid'];
           }
         }?>'>
                <!-- username-->
                <input type="name" class="input-field" id="username" name="username" placeholder="Student Name" disabled
                    value='<?php
          $query1="SELECT * FROM `students`where `students`.`studentid`='$studentid'";
          $result1= mysqli_query($mysqli, $query1);
          $resultCheck1 = mysqli_num_rows($result1);
          if ($resultCheck1 > 0) {
            while ($row1 = mysqli_fetch_assoc($result1)){
             echo $row1['username'];
           }
         }?>'>
                <!-- email -->
                <input type="email" class="input-field" id="email" name="email" placeholder="Email Address" disabled
                    value='<?php
          $query1="SELECT * FROM `students`where `students`.`studentid`='$studentid'";
          $result1= mysqli_query($mysqli, $query1);
          $resultCheck1 = mysqli_num_rows($result1);
          if ($resultCheck1 > 0) {
            while ($row1 = mysqli_fetch_assoc($result1)){
             echo $row1['email'];
           }
         }?>'>
                <!-- address -->
                <input type="address" class="input-field" id="address" name="address" placeholder="Address" disabled
                    value='<?php
          $query1="SELECT * FROM `students`where `students`.`studentid`='$studentid'";
          $result1= mysqli_query($mysqli, $query1);
          $resultCheck1 = mysqli_num_rows($result1);
          if ($resultCheck1 > 0) {
            while ($row1 = mysqli_fetch_assoc($result1)){
             echo $row1['address'];
           }
         }?>'>
                 <!-- birth -->
                <input type="date" class="input-field" id="birth" name="birth" placeholder="Date of Birth" disabled
                    value='<?php
          $query1="SELECT * FROM `students`where `students`.`studentid`='$studentid'";
          $result1= mysqli_query($mysqli, $query1);
          $resultCheck1 = mysqli_num_rows($result1);
          if ($resultCheck1 > 0) {
            while ($row1 = mysqli_fetch_assoc($result1)){
             echo $row1['birth'];
           }
         }?>'>
               <!-- phone -->
                <input type="phone" class="input-field" id="phone" name="phone" placeholder="Phone Number" disabled
                    value='<?php
          $query1="SELECT * FROM `students`where `students`.`studentid`='$studentid'";
          $result1= mysqli_query($mysqli, $query1);
          $resultCheck1 = mysqli_num_rows($result1);
          if ($resultCheck1 > 0) {
            while ($row1 = mysqli_fetch_assoc($result1)){
             echo $row1['phone'];
           }
         }?>'>
               <!-- Enrolled Units -->
                <input type="text" class="input-field" id="enrolled_Units" name="enrolUnit" placeholder="Enrolled Units" disabled
                    value='<?php
          $query1="SELECT * FROM `enrol`,`unit_second`
                  where `enrol`.`student_id`='$studentid'
                  and `unit_second`.`unit_id`=`enrol`.`unit_id`";
          $result1= mysqli_query($mysqli, $query1);
          $resultCheck1 = mysqli_num_rows($result1);
          if ($resultCheck1 > 0) {
            while ($row1 = mysqli_fetch_assoc($result1)){
             echo $row1['unit_code'];
           }
         }?>'>
             <!-- update button -->
                <input type="submit" class="registerbtn" id='update' name='update' value="Submit">
                <br />
                <br />
             <!-- edit button -->
                <input type="button" class="registerbtn" id='edit' name='studentsignup' value="Edit">
            </form>
        </div>
    </div>
    <script>
    // update button will hide until user click edit button 
    $(document).ready(function() {
        $('#update').hide();

        $('#edit').click(function() {
    //Once the user click edit button, these parts will be able to edit
            $('#update').show();
            $('#username').removeAttr('disabled');
            $('#email').removeAttr('disabled');
            $('#address').removeAttr('disabled');
            $('#birth').removeAttr('disabled');
            $('#phone').removeAttr('disabled');

        });

    });
    // add a validate function to the form
    // function validatestu() {
    //   var emailReg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    //   var passwordReg = /^^(?=.*[a-z])(?=.*[A-Z])(?=.*\d.*)(?=.*\W.*)[a-zA-Z0-9\S]{6,12}$/i;
    //   //student id is required
    //   if ($("#studentid").val() == "") {
    //     alert("Please enter your student ID.");
    //     return false;
    //   } //student name is required
    //   else if ($("#username").val() == "") {
    //     alert("Please enter your full name.");
    //     return false;
    //   } //email is required.
    //   else if ($("#email").val() == "") {
    //     ""
    //     alert("Please enter your email address");
    //     return false;
    //   } //email need to be valid.
    //   else if (!emailReg.test($("#email").val())) {
    //     alert("Please enter a valid email");
    //     return false;
    //   } //password is required.
    //   else if ($("#password").val() == "") {
    //     alert("Please enter your password.")
    //     return false;
    //   } //password need to be valid.
    //   else if (!passwordReg.test($("#password").val())) {
    //     alert("Please enter a valid password");
    //     return false;
    //   }
    //   //window.location.href = "./index.php";
    // //  return false;
    // };

    // function validatestaff() {
    //   var emailReg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    //   var passwordReg = /^^(?=.*[a-z])(?=.*[A-Z])(?=.*\d.*)(?=.*\W.*)[a-zA-Z0-9\S]{6,12}$/i;
    //   //staff id is required
    //   if ($("#staffid").val() == "") {
    //     alert("Please enter your staff ID.");
    //     return false;
    //   } //student name is required
    //   else if ($("#staffname").val() == "") {
    //     alert("Please enter your full name.");
    //     return false;
    //   } //email is required.
    //   else if ($("#staffemail").val() == "") {
    //     ""
    //     alert("Please enter your email address");
    //     return false;
    //   } //email need to be valid.
    //   else if (!emailReg.test($("#staffemail").val())) {
    //     alert("Please enter a valid email");
    //     return false;
    //   } //password is required.
    //   else if ($("#staffpassword").val() == "") {
    //     alert("Please enter your password.")
    //     return false;
    //   } //password need to be valid.
    //   else if (!passwordReg.test($("#staffpassword").val())) {
    //     alert("Please enter a valid password");
    //     return false;
    //   }
    //   //window.location.href = "./index.php";
    // //  return false;
    //
    // };
    // var password = document.getElementById("password"),
    //   confirm_password = document.getElementById("confirmpassword");
    //
    // function validatePassword() {
    //   if (password.value != confirm_password.value) {
    //     confirm_password.setCustomValidity("Passwords Don't Match");
    //   } else {
    //     confirm_password.setCustomValidity('');
    //   };
    // };
    // password.onchange = validatePassword;
    // confirm_password.onkeyup = validatePassword;
    //
    // var password = document.getElementById("staffpassword"),
    //   confirm_password = document.getElementById("staffconfirmpassword");
    //
    // function validatePassword() {
    //   if (password.value != confirm_password.value) {
    //     confirm_password.setCustomValidity("Passwords Don't Match");
    //   } else {
    //     confirm_password.setCustomValidity('');
    //   };
    // };
    // password.onchange = validatePassword;
    // confirm_password.onkeyup = validatePassword;
    //
    //
    //
    // var stu = document.getElementById("student");
    // var sta = document.getElementById("staff");
    // var btn = document.getElementById("btn");
    //
    // function regstaff() {
    //   stu.style.left = "-400px";
    //   sta.style.left = "50px";
    //   btn.style.left = "110px";
    // };
    //
    // function regstudent() {
    //   stu.style.left = "50px";
    //   sta.style.left = "450px";
    //   btn.style.left = "0px";
    // };
    </script>
</body>

</html>