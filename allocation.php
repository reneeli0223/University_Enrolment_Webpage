<?php
include 'db_conn.php';
//session include
include "session.php";
if ($session_user == "") {
    header('Location:./index.php?error=login_needed');
}
// Select students' information from students
$query = "SELECT * FROM `students` WHERE `username`='$session_user'";
$result = $mysqli->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);
$studentid = $row['studentid'];
$_SESSION['session_userid'] = $studentid;

// Once the user click enrol button, their information will be update on the database
if (isset($_POST['enrol'])) {
    $enrolarray = array_keys($_POST['enrol']);
    $enrolid = $enrolarray[0];
    $tutorialid = $_POST['tutorialid'];
    $query = "UPDATE `enrol` SET `tutorial_id`='$tutorialid' WHERE `enrol_id`='$enrolid'";
    $mysqli->query($query);
    header("location:allocation.php");
}

?>
<html>

<head>
    <title>Tutorial allocation</title>
    <link rel="stylesheet" type="text/css" href="css/allocation.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <!-- nav bar of the page same as other pages-->
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
    <!-- Background part -->
    <div id="backgroundContainer">
        <div class="text-center background jumbortron">
            <div class="padding">
                <h1 class="display-4">The University of DoWell </h1>
                <p class="display-10">Start Learning from today </p>
                <a class="btn btn-primary" href="unitEnrol.php">Unit Enrolment</a>
                <a class="btn btn-success" href="timetable.php">My timetable</a>
            </div>
        </div>
    </div>

    <div class="chooseTimetable">
        <?php
$query2 = "SELECT * FROM `enrol`,`tutorial`,`unit_second` WHERE `enrol`.`unit_id`=`tutorial`.`unit_id` and `enrol`.`student_id`='550671' and `enrol`.`unit_id`=`unit_second`.`unit_id`";
$result2 = mysqli_query($mysqli, $query2);

// $query3="SELECT * FROM `enrol` where `enrol`.`student_id`='550671' and `enrol`.`tutorial_id`=0";
// $result3=mysqli_query($mysqli,$query3);
// while ($row2= mysqli_fetch_assoc($result3)){
//   $enrolledunit=$row2['unit_code'];
//   echo "<tr id=". $row2["unit_code"].">
//   <td>". $row1["unit_code"]."</td>

//   <td></td></tr>";
// }
?>

        <div class="profilebar" id="profile">
            <div class="module">
                <div class="profileinfo">
                    <p>
                        Student Name:
                        <?php
$query1 = "SELECT * FROM `students`where `students`.`studentid`='$studentid'";
$result1 = mysqli_query($mysqli, $query1);
$resultCheck1 = mysqli_num_rows($result1);
if ($resultCheck1 > 0) {
    while ($row1 = mysqli_fetch_assoc($result1)) {
        echo $row1['username'];
    }
}
?>
                    </p>
                    <p>
                        Email Address:
                        <?php
$query1 = "SELECT * FROM `students`where `students`.`studentid`='$studentid'";
$result1 = mysqli_query($mysqli, $query1);
$resultCheck1 = mysqli_num_rows($result1);
if ($resultCheck1 > 0) {
    while ($row1 = mysqli_fetch_assoc($result1)) {
        echo $row1['email'];
    }
}
?>
                    </p>
                </div>
            </div>
            <!-- Start of module -->
            <div class="module">
                <div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Unit Code</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$queryIfEnrolled = "SELECT * FROM `enrol`,`tutorial`,`unit_second`
                              WHERE `enrol`.`tutorial_id`=`tutorial`.`tutorial_id`
                              and `enrol`.`unit_id`=`unit_second`.`unit_id`
                              and `enrol`.`student_id`='$session_userid'";
//select enrolled tutorial from enrol

$resultIfEnrolled = mysqli_query($mysqli, $queryIfEnrolled);
while ($row2 = mysqli_fetch_assoc($resultIfEnrolled)) {
    $enrolledTutorial[] = $row2["unit_code"];
    echo "<tr>
                                <td>" . $row2["unit_code"] . "</td>
                                <td>" . $row2["time"] . "</td>
                                <td>Enrolled</td>
                                </tr>";}
// display enrolled tutorial from enrol

$queryUnenolledTut = "SELECT `unit_second`.`unit_code`,`enrol`.`enrol_id`,`tutorial`.`tutorial_id`,`tutorial`.`time`,`tutorial`.`capacity` FROM `enrol`,`tutorial`,`unit_second`
                              WHERE `enrol`.`unit_id`=`tutorial`.`unit_id`
                              and `enrol`.`unit_id`=`unit_second`.`unit_id`
                              and `enrol`.`student_id`='$session_userid'";
// select enrolled unit(without tutorial) and its tutorial time from enrol

$result = mysqli_query($mysqli, $queryUnenolledTut);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
    while ($rowUnenolledTut = mysqli_fetch_assoc($result)) {
        $unit_code = $rowUnenolledTut['unit_code'];
        $tutorialid = $rowUnenolledTut['tutorial_id'];
        if (!in_array($rowUnenolledTut['unit_code'], $enrolledTutorial)) {
            echo "<tr>
                                    <form action='' method='post'>

                                                 <input type='hidden' name='tutorialid' value='" . $tutorialid . "'>
                                          <td>" . $rowUnenolledTut["unit_code"] . "</td>
                                          <td>" . $rowUnenolledTut["time"] . "</td>
                                          <td><input type='submit' value='enrol' name='enrol[" . $rowUnenolledTut["enrol_id"] . "]'/></td>";
            echo "
                                        </td>
                                    </form>
                                          </tr>";

        }
    }
}
?>
                        </tbody>
                    </table>
                    <!-- form for the options -->
                </div>
            </div>
        </div>
        <!-- End of module -->

    </div>

    <!-- End of profile part -->
    <!-- script for the button -->
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