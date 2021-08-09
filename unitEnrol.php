<?php
include 'db_conn.php';
//session include
include "session.php";
$query = "SELECT * FROM `students` WHERE `username`='$session_user'";
$result = $mysqli->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);
$studentid = $row['studentid'];
//$_SESSION['session_userid']=$studentid;

if (isset($_POST['enrolbtn'])) {
    $enrolunit = $_POST['enrolunit'];
    $selectunit = $_POST['selectunit'];
    print_r($enrolunit);
    print_r($selectunit);
    foreach ($enrolunit as $unitcode => $v) {
        $unitid = $selectunit[$unitcode];

//  $query="INSERT INTO `enrol`(`student_id`, `unit_id`) VALUE ('$session_user','$unitid')";
        $query = "INSERT INTO `enrol`(`student_id`, `unit_id`) VALUE ('$studentid','$unitid')";
        print_r($query);
        $mysqli->query($query);
        echo $mysqli->error;

    }

}

if ($session_user == "") {
    header('Location:./index.php?error=login_needed');
}

?>
<html>

<head>
    <title>Enrol your unit now</title>
    <link rel="stylesheet" type="text/css" href="css/unitEnrol.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
        </div>
    </nav>
    <!-- End of Nav bar -->
    <!-- background part -->
    <div id="backgroundContainer">
        <div class="text-center background jumbortron">
            <div class="padding">
                <h1 class="display-4">The University of DoWell </h1>
                <p class="display-10">Start Learning from today </p>
                <a class="btn btn-primary" href="unitdetail.php">Unit Details</a>
                <a class="btn btn-success" href="timetable.php">My timetable</a>
            </div>
        </div>
    </div>
    <!-- background part -->
    <!-- Unit enrol table -->
    <div class="unitEnrollment">
        <h2>My current programs</h2>

        <form action="" method='post'>


            <table class="table table-striped" id="tableView">
                <thead>
                    <tr>

                        <th>
                            Unit Code
                        </th>

                        <th>
                            Semester and campus
                        </th>

                        <th>

                        </th>

                    </tr>
                </thead>

                <tbody>
                <!-- select enrol unit information from database -->
                    <?php

$query1 = "SELECT * FROM `enrol`,`unit_second` WHERE `enrol`.`unit_id`=`unit_second`.`unit_id` and `enrol`.`student_id`='$studentid'";
$result1 = mysqli_query($mysqli, $query1);
while ($row1 = mysqli_fetch_assoc($result1)) {
    $enrolledunit[] = $row1["unit_code"];
    echo "<tr id=" . $row1["id"] . ">
      <td>" . $row1["unit_code"] . "</td>
      <td>enrolled</td>
      <td></td></tr>";
}
$sql = "SELECT * FROM unit_master;";
$result = mysqli_query($mysqli, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $unit_code = $row['unit_code'];
        if (!in_array($row['unit_code'], $enrolledunit)) {
            echo "<tr id=" . $row["id"] . ">
                  <td>" . $row["unit_code"] . "</td>";

            ?>
                    <td>
                    <!-- Select campus and semester option -->

                        <select name='selectunit[<?php echo $unit_code; ?>]'>
                            <?php
$query2 = "SELECT * FROM `unit_second` WHERE `unit_second`.`unit_code`='$unit_code' ";
            $result2 = $mysqli->query($query2);
            while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) {
                $unit_id = $row2['unit_id'];
                ?>
                            <option value='<?php echo $unit_id; ?>'>
                                <?php echo $row2["semester"] . "    " . $row2["campus"]; ?>
                            </option>
                            <?php
}

            echo "    </select>
              </td>";

            echo "      <td>
                <input type='checkbox' name='enrolunit[" . $unit_code . "]' id='enrolcheck' />
                </td></tr>";

        }
    }
}
?>
                </tbody>
            </table>
            <!-- table end -->
            <div class="enrolBtn">
                <input type='submit' name='enrolbtn' id='enrolbtn' value='Enrol'>
            </div>

        </form>
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