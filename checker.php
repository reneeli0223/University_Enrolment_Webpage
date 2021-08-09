<?php

include('db_conn.php');
//get the q parameter from URL
$search = $_GET["search_term"];
$query = "SELECT * FROM `students`,`enrol`,`tutorial`,`unit_second`
where `unit_second`.`unit_id`=`enrol`.`unit_id`
and `students`.`studentid`=`enrol`.`student_id`
and `enrol`.`tutorial_id`=`tutorial`.`tutorial_id`
and  (`students`.`studentid` like '%$search%' OR
	  `students`.`username` like '%$search%' or `unit_second`.`unit_code` like '%$search%')";

$result = $mysqli->query($query);


// $result = mysqli_query($mysqli,$query);




if ($result) {
		echo "We found ".$result->num_rows." result(s)<br>";
		while($row =$result->fetch_assoc()){
		echo "<table class='table table-bordered'>";


		echo "<tr><td>Unit Code</td><td>".$row["unit_code"]."</td></tr>";
		echo "<tr><td>Student ID</td><td>".$row["studentid"]."</td></tr>";
		echo "<tr><td>Student Name</td><td>".$row["username"]."</td></tr>";
		echo "<tr><td>Tutorial Time</td><td>".$row["time"]."</td></tr>";

		echo "</table>";
}
}
?>
