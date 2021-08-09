<?php
//db connection
include('db_conn.php');
//session include
include("session.php");


if(isset($_POST['submit'])){
  $unit_code = $_POST['unit_code'];
  $lecturer_id = $_POST['lecturer_id'];
  $semester = $_POST['semester'];
  $consultation=$_POST['consultation'];
  $campus=$_POST['campus'];

  $query = "INSERT INTO `unit_second` ( `unit_code`, `lecturer_id`,`semester`,`campus`,`consultation`)
  VALUES (  '$unit_code', '$lecturer_id','$semester','$campus','$consultation')";

  $mysqli->query($query);
  header('Location:Master_unit.php');
}
?>
<html>

<head>
    <title>Welcome Degree coordinator</title>
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

<body><br>
    <div class="container">
        <h2 align="center">Manage Unit details</h2>
        <div class="row mt-5">
            <div class="col-sm-12">
                <a href="index.php" class="btn btn-link float-left active" id="btnback" role="button"
                    aria-pressed="true">Back to the main</a>
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
                            <div class="modal-content" id="output" style="display: none;">

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" id="closeButton" data-dismiss="modal"
                                    onclick="closeContent()">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- table start -->
                <table class="table table-striped" id="tableView">
                    <thead>
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>
                                Unit Code
                            </th>

                            <th>
                                Lecturer
                            </th>
                            <th>
                                Semester
                            </th>
                            <th>
                                Campus
                            </th>
                            <th>
                                Consultation
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <!-- select unit detail and staff info from database -->
                        <?php
                  $sql = "SELECT * FROM `unit_second`,`staff` where `unit_second`.`lecturer_id`=`staff`.`staffid`";
                  $result = mysqli_query($mysqli, $sql);
                  $resultCheck = mysqli_num_rows($result);
                  if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                      $unitcode=$row["unit_code"];
                      echo "
                      <form action='editdetail.php' method='post'>


                      <tr id=". $row["unit_id"].">
                      <td>". $row["unit_id"]."</td>
                      <td>". $row["unit_code"]."</td>
                        <td>".$row["username"]."</td>
                        <td>". $row["semester"]."</td>
                        <td>".$row["campus"]."</td>
                        <td>".$row["consultation"]."</td>
                        <td>
                        <input type='submit' value='Unit Detail' name='unit[".$unitcode."]' />
                        </td>
                       
                      </tr>
                      </form>

                      ";
                    }
                  }
                  ?>
                    </tbody>
                </table>
                <!-- table end -->
                <!-- Add new unit -->
                <button class="btn btn-primary float-right active" role="button" id="btnSearch" aria-pressed="true"
                    data-toggle="modal" data-target="#add_Modal">Add New Unit</button>
                <div class="modal fade" id="add_Modal" tabindex="-1" role="dialog" aria-labelledby="add_ModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalLabel">Add New Unit</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" onclick="closeContent()">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="searchPage">
                                <div class="form-group">
                                    <form action="" method="POST">
                                        <label for="search_term" class="col-form-label" id="add">Unit Code</label>
                                        <input type="text" class="form-control" name="unit_code" required>
                                        <label for="search_term" class="col-form-label" id="add">Unit Name</label>
                                        <input type="text" class="form-control" name="unit_name" required>
                                        <label for="search_term" class="col-form-label" id="add">Lecturer ID</label>
                                        <input type="text" class="form-control" name="lecturer_id" required>
                                        <label for="search_term" class="col-form-label" id="add">Semester</label>
                                        <input type="text" class="form-control" name="semester" required>
                                        <label for="search_term" class="col-form-label" id="add">Campus</label>
                                        <input type="text" class="form-control" name="campus" required>
                                        <label for="search_term" class="col-form-label" id="add">Consultation</label>
                                        <input type="text" class="form-control" name="consultation" required>
                                        <input type="submit" class="btn btn-warning float-left" name="submit"
                                            value="Add">
                                    </form>
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
            </div>
        </div>
    </div>


    <!-- php code for lecturers select and option part -->
    <?php
      $query="SELECT * FROM `staff_role`,`staff` where `staff_role`.`role`=3 and `staff_role`.`staffid`=`staff`.`staffid`";
      $result=$mysqli->query($query);
      while($row=$result->fetch_array(MYSQLI_ASSOC)){

        $lecturername=$row['username'];
        $lecturerid=$row['staffid'];
        $lecturers[$lecturerid]=$lecturername;
      }
     // print_r($lecturers);
      $lecturers=json_encode($lecturers);
      //print_r($lecturers);

      echo  "<script> 
      
      var aaa='$lecturers';
      
      </script>  
";


?>

    <script>
    $(document).ready(function() {
        $('#tableView').Tabledit({
            url: 'tableUpdater.php',
            columns: {
                identifier: [0, 'unit_id'],
                editable: [
                    [1, 'unit_code'],
                    [2, 'lecturer', aaa],
                    [3, 'semester',
                        '{"Semester 1": "Semester 1", "Semester 2": "Semester 2", "Spring School": "Spring School","Summer School": "Summer School"}'
                    ],
                    [4, 'campus',
                        '{"Pandora": "Pandora", "Rivendell": "Rivendell", "Neverland": "Neverland"}'
                    ],
                    [5, 'consultation']

                ]
            },

            onDraw: function() {
                console.log('onDraw()');
            },
            onSuccess: function(data, textStatus, jqXHR) {
                console.log('onSuccess(data, textStatus, jqXHR)');
                console.log(data);
                console.log(textStatus);
                console.log(jqXHR);
                if (data.action == 'delete') {
                    $('#' + data.id).remove();

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
    });
    </script>



</body>

</html>