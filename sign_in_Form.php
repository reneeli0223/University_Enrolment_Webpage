<?php
//include the file session.php
include("session.php");

//if the session for username has been set, automatically go to "signin_success.php"
if($session_user!="") {
	header('location: ./index.php');
}

//if there is any received error message
if(isset($_GET['error']))
{
	//show error message using javascript alert
	echo "<script>alert('Do not have a record');</script>";
}
?>
<html>
<head>
  <title>Sign in</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <style>
  h1 {
    text-align: center;
    margin-top: 20px;
  }

  </style>
</head>
<body>

<div class="container">
  <div class="formDiv">
      <h1>Please sign in</h1>
      <form action="signin_engine.php" method="POST" class="col-lg-6 offset-lg-3">
        <div class="form-group">
					<p>
						Login  as
					</p>
					<label for='student'>Student </label><input  type='radio' name='role' id='student' value='student' required/>
					<label for='staff'>Staff </label>	<input  type='radio' name='role' id='staff' value='staff' /><br />
          <label for="username">Username:</label>
          <input type="username" class="form-control"  placeholder="Username" name="username" id="username">
        	<!-- </div>
        	<div class="form-group"> -->
          <label for="password">Password:</label>
          <input type="password" class="form-control" placeholder="Password" name="password" id="password">
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
        <a href="index.php" type="submit" class="btn btn-danger btn-lg btn-block">Cancel</a>
      </form>
  </div>
</div>

</body>
</html>
