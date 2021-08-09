<?php
//include the file session.php
include("session.php");
//include the file db_conn.php
include("db_conn.php");
$role=$_POST['role'];


//receive the username data from the form (in signin_form.php)
$user=$_POST['username'];
//receive the password data from the form (in signin_form.php)
$password=$_POST['password'];
if($role=='student'){
//query to check whether username is in the table (check whether the user has been signed up)
$query = "SELECT * FROM students WHERE username='$user'";

}else{
	$query = "SELECT * FROM staff WHERE username='$user'";
}

//execute query to the database and retrieve the result ($result)
$result = $mysqli->query($query);

//convert the result to array (the key of the array will be the column names of the table)
	$row=$result->fetch_array(MYSQLI_ASSOC);

//if the username from table is not same as the username data from the form(from signin_form.php)
if($row['username']!=$user || $user=="")
{
	//automatically go back to signin_form and pass the error message
	header('Location: ./sign_in_Form.php?error=invalid_username');
}
//if the username is same as the username data from the form(from signin_form.php)
else {
	//if the password from table is same as the password data from the form(from signin_form.php)
//	if($row['password']==$password) {





// let the salt be automatically generated
if (hash_equals($row['password'], crypt($password,$row['password']))) {

		//save the username in the session
		$session_user=$row['username'];
		$_SESSION['session_user']=$session_user;
		$session_role=$row['access'];
		$_SESSION['session_role']=$session_role;
		if($session_role==0){
		$session_userid=$row['studentid'];
	}else{
	$session_userid=$row['staffid'];

	}
		$_SESSION['session_userid']=$session_userid;

		//automatically go to signin_success.php
		header('Location: ./index.php');

	}//if the password from table does not match with the password data from the signin form
	else{

		//automatically go back to signin_form and pass the error message
		header('Location: ./sign_in_Form.php?error=invalid_password');
	}
}



?>
