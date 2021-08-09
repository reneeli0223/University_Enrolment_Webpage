<?php
include 'db_conn.php';
//session include
include "session.php";
if (isset($_POST['submit'])) {
    //$id =  $_POST['id'];
    $time = $_POST['time'];
    $capacity = $_POST['capacity'];
    $unit_id = $_POST['unit_id'];
    $tutor_id = $_POST['tutor_id'];

    $query = "INSERT INTO `tutorial` (`time`, `capacity`, `unit_id`, `tutor_id`)
  VALUES ( '$time', '$capacity', '$unit_id','$tutor_id')";

    $mysqli->query($query);
    header('Location:editTutorial.php');
}
?>
<html>

<head>
    <title>View Unit Detail</title>
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
    <script src="./tutorial.tabledit.js"></script>
    <link rel="stylesheet" type="text/css" href="css/editTutorial.css">
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
    </nav>
    <!-- Start tutorial detail php -->
    <div id="pageContainer">
        <div id="page">

            <div class="contentArea" role="main">
                <div class="form-box">
                    <table class="table table-striped" id="tableView">
                        <thead>
                            <tr>
                                <th>
                                    Tutorial ID
                                </th>
                                <th>
                                    Unit ID
                                </th>
                                <th>
                                    Unit Code
                                </th>

                                <th>
                                    Campus
                                </th>
                                <th>
                                    Tutor
                                </th>

                                <th>
                                    Tutorial time
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Select unit detail , staff detail and tutorial detail from database-->
                            <?php
$sql = "SELECT * FROM `unit_second`,`staff`,`tutorial`
                  where `unit_second`.`unit_id`=`tutorial`.`unit_id`
                  and `tutorial`.`tutor_id`=`staff`.`staffid`
                  and `staff`.`access`=4";
$result = mysqli_query($mysqli, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $unitcode = $row["unit_code"];
        $staffName = $row["username"];
        echo "
                      <form action='' method='post' >


                      <tr id=" . $row["tutorial_id"] . ">
                      <td>" . $row["tutorial_id"] . "</td>
                      <td>" . $row["unit_id"] . "</td>
                      <td>" . $row["unit_code"] . "</td>
                      <td>" . $row["campus"] . "</td>
                      <td>" . $row["username"] . "</td>
                      <td>" . $row["time"] . "</td>
                      </tr>
                      </form>

                      ";
    }
}
?>
                        </tbody>
                    </table>
                    <!-- Add new tutorial-->
                    <button class="btn btn-primary  active" role="button" id="btnSearch" aria-pressed="true"
                        data-toggle="modal" data-target="#add_Modal">Add New Tutorial</button>
                    <div class="modal fade" id="add_Modal" tabindex="-1" role="dialog" aria-labelledby="add_ModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ModalLabel">Add New Tutorial</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" onclick="closeContent()">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="searchPage">
                                    <div class="form-group">
                                        <form action="" method="POST">
                                            <label for="search_term" class="col-form-label" id="add">Time</label>
                                            <input type="text" class="form-control" name="time" required>

                                            <label for="search_term" class="col-form-label" id="add">Capacity</label>
                                            <input type="text" class="form-control" name="capacity" required>

                                            <label for="search_term" class="col-form-label" id="add">Unit ID</label>
                                            <input type="text" class="form-control" name="unit_id" required>

                                            <label for="search_term" class="col-form-label" id="add">Tutor ID</label>
                                            <input type="text" class="form-control" name="tutor_id" required>

                                            <input type="submit" class="btn btn-warning float-left" name="submit"
                                                value="Add">
                                        </form>
                                    </div>
                                </div>

                                <div class="modal-content" id="output" style="display: none;">

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" id="closeButton"
                                        data-dismiss="modal" onclick="closeContent()">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tutor's select and option part-->
                <?php
$query = "SELECT * FROM `staff_role`,`staff` where `staff_role`.`role`=4 and `staff_role`.`staffid`=`staff`.`staffid`";
$result = $mysqli->query($query);
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    $tutorName = $row['username'];
    $tutor_id = $row['staffid'];
    $tutors[$tutor_id] = $tutorName;
}
// print_r($lecturers);
$tutors = json_encode($tutors);
//print_r($lecturers);

echo "<script>

                        var tutors='$tutors';

                        </script>
                  ";

?>

                <!-- script for tableedit -->

                <script>
                $(document).ready(function() {
                    $('#tableView').Tabledit({
                        url: 'tutorialUpdater.php',
                        columns: {
                            identifier: [0, 'tutorial_id'],
                            editable: [
                                [3, 'campus',
                                    '{"1": "Pandora", "2": "Neverland", "3": "Rivendell"}'],
                                [4, 'tutors', tutors],
                                [5, 'time']

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