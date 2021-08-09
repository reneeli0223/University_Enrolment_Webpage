<?php

// Basic example of PHP script to handle with jQuery-Tabledit plug-in.
// Note that is just an example. Should take precautions such as filtering the input data.

header('Content-Type: application/json');

$input = filter_input_array(INPUT_POST);

$mysqli = new mysqli('localhost', 'daruil', '550671', 'daruil');

if (mysqli_connect_errno()) {
  echo json_encode(array('mysqli' => 'Failed to connect to MySQL: ' . mysqli_connect_error()));
  exit;
}

if ($input['action'] === 'edit') {
    $mysqli->query("UPDATE students SET username='" . $input['username'] . "', email='" . $input['email'] . "', address='" . $input['address'] . "', birth='" . $input['birth'] . "' WHERE studentid='" . $input['studentid'] . "'");
}
mysqli_close($mysqli);

echo json_encode($input);
