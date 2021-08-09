<?php
include('db_conn.php');
include('session.php');
if(isset($_POST['studentsignup'])){
  $username=$_POST["username"];
  $password=$_POST["password"];
  $address=$_POST["address"];
  $birth=$_POST["birth"];
  $phone=$_POST["phone"];
  $email=$_POST["email"];
  $id=$_POST["studentid"];

  $access=0;
  $hashed_password = crypt( $password);
  $query="SELECT `studentid` FROM `students`  WHERE `studentid` LIKE '$id'";
  $result=$mysqli -> query($query);
  $result_cnt = $result->num_rows;

  if($result_cnt!=0){
    echo "<script> alert ('Userid Exist');</script>";
  }else{
    $query="INSERT INTO `students`(`studentid`, `username`, `password`, `email`, `address`, `birth`, `access`,`phone`)
    Values ('$id','$username','$hashed_password','$email','$address','$birth','$access','$phone')";
    $mysqli -> query($query);
//echo  $mysqli->error;
    $session_user=$username;
    $_SESSION['session_user']=$session_user;
    $session_role=0;
		$_SESSION['session_role']=$session_role;
   header('Location:index.php');
  }
}

if(isset($_POST['staffsignup'])){
  $id=$_POST["staffid"];
  $staffname=$_POST["staffname"];
  $email=$_POST["email"];
  $password=$_POST["password"];
  $qualification=$_POST["qualification"];
  $expertise=$_POST["expertise"];
  $phone=$_POST["phone"];

  $access=1;
  $hashed_password = crypt( $password);
  $query="SELECT `username` FROM `staff`  WHERE `username` LIKE '$staffname'";
  $result=$mysqli -> query($query);
  $result_cnt = $result->num_rows;

  if($result_cnt!=0){
    echo "<script> alert ('Username Exist');</script>";
  }else{
    $query="INSERT INTO `staff` (`staffid`, `username`, `email`, `password`, `qualification`, `expertise`, `phone`, `access`)
    Values ('$id','$staffname', '$email','$hashed_password','$qualification','$expertise','$phone','$access')";
    $mysqli -> query($query);

    $session_user=$staffname;
    $_SESSION['session_user']=$session_user;
    $session_role=0;
		$_SESSION['session_role']=$session_role;
   header('Location:index.php');
  }
}
 ?>
<html>

<head>
    <title>Register now</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"> </script>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <style>
    #form-box {
        height: 60%;
    }
    </style>
</head>

<body>
    <div class="register">
        <div class="form-box" id="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <!-- studnet and staff button -->
                <button type="button" class="toggle-btn" onclick="regstudent()">Student</button>
                <button type="button" class="toggle-btn" onclick="regstaff()">Staff</button>
            </div>
            <!-- application form for student -->
            <form id="student" class="input-group" method="post" action="" onsubmit="return validatestu();"
                name="registration">
                <input type="text" class="input-field" id="studentid" name="studentid" placeholder="Student ID">
                <input type="text" class="input-field" id="username" name="username" placeholder="Student Name">
                <input type="email" class="input-field" id="email" name="email" placeholder="Email Address">
                <input type="password" class="input-field" id="password" name="password" placeholder="Password">
                <input type="password" class="input-field" id="confirmpassword" name="confirmPassword"
                    placeholder="Confirm Password">
                <input type="address" class="input-field" id="address" name="address" placeholder="Address">
                <input type="date" class="input-field" id="birth" name="birth" placeholder="Date of Birth">
                <input type="phone" class="input-field" id="phone" name="phone" placeholder="Phone Number">
                <input type="submit" class="registerbtn" name='studentsignup' value="Register">
            </form>
            <!-- application form for staff -->
            <form id="staff" class="input-group" method="post" action="" onsubmit="return validatestaff();"
                name="registration">
                <input type="text" class="input-field" id="staffid" name="staffid" placeholder="Staff ID" required>
                <input type="text" class="input-field" id="staffname" name="staffname" placeholder="Staff Name"
                    required>
                <input type="email" class="input-field" id="staffemail" name="email" placeholder="Email Address">
                <input type="password" class="input-field" id="staffpassword" name="password" placeholder="Password">
                <input type="password" class="input-field" id="staffconfirmpassword" name="confirmPassword"
                    placeholder="Confirm Password">
                <input type="qualification" class="input-field" id="qualification" name="qualification"
                    placeholder="Qualification" required>
                <input type="expertise" class="input-field" id="birth" name="expertise" placeholder="Expertise"
                    required>
                <input type="phone" class="input-field" id="phone" name="phone" placeholder="Phone Number" required>
                <button type="submit" name="staffsignup" class="registerbtn">Register</button>
            </form>
        </div>
    </div>
    <script>
    // add a validate funtion to the form
    function validatestu() {
        var emailReg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        var passwordReg = /^^(?=.*[a-z])(?=.*[A-Z])(?=.*\d.*)(?=.*\W.*)[a-zA-Z0-9\S]{6,12}$/i;
        //student id is required
        if ($("#studentid").val() == "") {
            alert("Please enter your student ID.");
            return false;
        } //student name is required
        else if ($("#username").val() == "") {
            alert("Please enter your full name.");
            return false;
        } //email is required.
        else if ($("#email").val() == "") {
            ""
            alert("Please enter your email address");
            return false;
        } //email need to be valid.
        else if (!emailReg.test($("#email").val())) {
            alert("Please enter a valid email");
            return false;
        } //password is required.
        else if ($("#password").val() == "") {
            alert("Please enter your password.")
            return false;
        } //password need to be valid.
        else if (!passwordReg.test($("#password").val())) {
            alert("Please enter a valid password");
            return false;
        }
        window.location.href = "./index.php";
        return false;
    };

    function validatestaff() {
        var emailReg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        var passwordReg = /^^(?=.*[a-z])(?=.*[A-Z])(?=.*\d.*)(?=.*\W.*)[a-zA-Z0-9\S]{6,12}$/i;
        //staff id is required
        if ($("#staffid").val() == "") {
            alert("Please enter your staff ID.");
            return false;
        } //student name is required
        else if ($("#staffname").val() == "") {
            alert("Please enter your full name.");
            return false;
        } //email is required.
        else if ($("#staffemail").val() == "") {
            ""
            alert("Please enter your email address");
            return false;
        } //email need to be valid.
        else if (!emailReg.test($("#staffemail").val())) {
            alert("Please enter a valid email");
            return false;
        } //password is required.
        else if ($("#staffpassword").val() == "") {
            alert("Please enter your password.")
            return false;
        } //password need to be valid.
        else if (!passwordReg.test($("#staffpassword").val())) {
            alert("Please enter a valid password");
            return false;
        }
        //window.location.href = "./index.php";
        //  return false;

    };
    var password = document.getElementById("password"),
        confirm_password = document.getElementById("confirmpassword");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        };
    };
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;

    var password = document.getElementById("staffpassword"),
        confirm_password = document.getElementById("staffconfirmpassword");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        };
    };
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;



    var stu = document.getElementById("student");
    var sta = document.getElementById("staff");
    var btn = document.getElementById("btn");

    function regstaff() {
        stu.style.left = "-400px";
        sta.style.left = "50px";
        btn.style.left = "110px";
    };

    function regstudent() {
        stu.style.left = "50px";
        sta.style.left = "450px";
        btn.style.left = "0px";
    };
    </script>
</body>

</html>