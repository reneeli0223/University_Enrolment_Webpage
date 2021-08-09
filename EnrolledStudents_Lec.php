<?php
//db connection
include('db_conn.php');
//session include
include("session.php");

?>

<html>

<head>
    <title>Welcome Lecturers </title>
    <link rel="stylesheet" type="text/css" href="css/UCpage.css">

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
    <!-- add library-->
    <script src="./jquery.tabledit.js"></script>
</head>

<body>
    <div class="container"><br>
        <h2 align="center">Enrolled Students list</h2>
        <div class="row mt-5">
            <div class="col-sm-12">
                <a href="index.php" class="btn btn-link float-left active" id="btnback" role="button" aria-pressed="true">Back to the main</a>
                <button id="btnSearch" class="btn btn-light float-right" data-toggle="modal"
                    data-target="#search_Modal">Search</button>
                <div class="modal fade" id="search_Modal" tabindex="-1" role="dialog"
                    aria-labelledby="search_ModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document" id="search_output">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalLabel">Search</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" onclick="closeContent()">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="searchPage">

                                <div class="form-group">
                                    <label for="search_term" class="col-form-label" id="search">Search</label>
                                    <input type="text" class="form-control" id="search_term">
                                </div>
                                <div class="searchBtn">
                                    <button id="btnSearch2" class="btn btn-warning float-left">Search</button>
                                </div>

                            </div>

                            <div class="modal-content" id="output" style="display: none;">

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" id="closeButton" data-dismiss="modal"
                                    onclick="closeContent()">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped" id="tableView">
                    <thead>
                        <tr>
                            <th>
                                Unit Code
                            </th>
                            <th>
                                Student ID
                            </th>

                            <th>
                                Student Name
                            </th>
                            <th>
                                Lecture Time
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                  $sql = "SELECT * FROM `students`,`enrol`,`unit_second`,`lecture`
                   where `unit_second`.`unit_id`=`enrol`.`unit_id`
                   and `students`.`studentid`=`enrol`.`student_id`
                   and `lecture`.`unit_id`=`unit_second`.`unit_id`";
                  $result = mysqli_query($mysqli, $sql);
                  $resultCheck = mysqli_num_rows($result);
                  if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                      $unitcode=$row["unit_code"];
                      $time=$row["time"];
                      echo "
                      <tr id=". $row["unit_code"].">
                      <td>". $row["unit_code"]."</td>
                      <td>". $row["student_id"]."</td>
                 
                        <td>".$row["username"]."</td>
                        <td>". $row["lecture_time"]."</td>
                       
                       
                      </tr>

                      ";
                    }
                  }
                  ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>





</body>
<script>

  $("#btnSearch2").click(function(){
  var search_term = $("#search_term").val();
  $.get("checker.php",{search_term:search_term}).done(function(data)
  {
      $("#output").html(data);
      $("#output").show();
      $("#searchPage").hide();
    })
  });
  function closeContent(){

      document.getElementById("searchPage").style.display =  "block";
      document.getElementById("output").style.display = "none";
      document.getElementById("search_term").value="";

  }

  </script>













</html>