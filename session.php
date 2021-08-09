<?php
//starting session
session_start();

//if the session for username has not been set, initialise it
if(!isset($_SESSION['session_user'])){
	$_SESSION['session_user']="";
}
//save username in the session
$session_user=$_SESSION['session_user'];


if(!isset($_SESSION['session_role'])){
	$_SESSION['session_role']="";
}
//save username in the session
$session_role=$_SESSION['session_role'];


if(!isset($_SESSION['session_userid'])){
	$_SESSION['session_userid']="";
}
//save username in the session
$session_userid=$_SESSION['session_userid'];
?>
