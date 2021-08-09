<?php
//db connection
include('db_conn.php');
//session include
include("session.php");


if(isset($_POST['submit'])){
  $id =  $_POST['staffid'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $query = "INSERT INTO `staff` (`staffid`, `username`, `email`)
  VALUES ( '$id', '$username', '$email')";
  $mysqli->query($query);
  header('Location:DCpage_academic.php');
}
?>
<html>

  <head>
    <title>Welcome Degree coordinator</title>
    <link rel="stylesheet" type="text/css" href="css/UCpage.css">
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
    <!-- add library-->
    <script src="jquery.tabledit.js"></script>
  </head>

  <body>
      <div class ="container">
          <h2 align ="center">Manage Academic Staff</h2>
          <div class ="row mt-5">
            <div class="col-sm-12">
              <a href="index.php" class="btn btn-link float-left active" id="btnback" role="button" aria-pressed="true">Back to the main</a>
              <div class="modal fade" id="search_Modal" tabindex="-1" role="dialog" aria-labelledby="search_ModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" id="search_output">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="ModalLabel">Search</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" onclick="closeContent()">&times;</span>
                      </button>
                    </div>
                    <div class="modal-content" id="output" style="display: none;">

                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" id="closeButton" data-dismiss="modal" onclick="closeContent()">Close</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- table start -->
              <table class="table table-striped" id="tableView">
                <thead>
                  <tr>
                    <th>
                      Staff name
                    </th>
                    <th>
                      Availability
                    </th>
                    <th>
                      Access
                    </th>
                  </tr>
                </thead>

                <tbody>
                 <!-- select staff information from database -->
                  <?php
                  $sql = "SELECT * FROM staff;";
                  $result = mysqli_query($mysqli, $sql);
                  $resultCheck = mysqli_num_rows($result);
                  if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                      echo "
                      <tr id=". $row["id"].">
                      <td>". $row["username"]."</td>
                      <td>". $row["availability"]."</td>
                      <td>". $row["access"]. "</td>
                      </tr>
                      ";
                    }
                  }
                  ?>
                </tbody>
              </table>
               <!-- Table end -->
                <!-- Add new staff -->
              <button class="btn btn-primary float-right active"role="button" id="btnSearch" aria-pressed="true" data-toggle="modal" data-target="#add_Modal">Add New Staff</button>
              <div class="modal fade" id="add_Modal" tabindex="-1" role="dialog" aria-labelledby="add_ModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="ModalLabel">Add New Staff</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" onclick="closeContent()">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" id="searchPage">
                        <div class="form-group">
                          <form action="" method="POST">
                            <label for="search_term" class="col-form-label" id="add">Staff ID</label>
                            <input type="text" class="form-control" name="staffid" required>

                            <label for="search_term" class="col-form-label" id="add">Staff Name</label>
                            <input type="text" class="form-control" name="username" required>

                            <label for="search_term" class="col-form-label" id="add">Email</label>
                            <input type="text" class="form-control" name="email" required>

                            <input type="submit" class="btn btn-warning float-left" name="submit" value="Add">
                          </form>
                        </div>
                    </div>

                    <div class="modal-content" id="output" style="display: none;">

                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" id="closeButton" data-dismiss="modal" onclick="closeContent()">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      <script>

  $('#tableView').Tabledit({
  url: 'updaterStaff.php',
  columns: {
      identifier: [0, 'username'],
      editable: [[2,'access']]
           },

  onDraw: function() {
      console.log('onDraw()');
                     },
  onSuccess: function(data, textStatus, jqXHR) {
      console.log('onSuccess(data, textStatus, jqXHR)');
      console.log(data);
      console.log(textStatus);
      console.log(jqXHR);
      if(data.action == 'delete'){
        $('#'+data.id).remove();

      }
  },
  onFail: function(jqXHR, textStatus, errorThrown) {
      console.log('onFail(jqXHR, textStatus, errorThrown)');
      console.log(jqXHR);
      console.log(textStatus);
      console.log(errorThrown);
  },
  onAlways: function() {
      console.log('onAlways()');
  },
  onAjax: function(action, serialize) {
      console.log('onAjax(action, serialize)');
      console.log(action);
      console.log(serialize);
  }
});
      </script>
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

  </body>

</html>
