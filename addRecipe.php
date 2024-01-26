<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
header('Content-Type: application/json');

require 'db.php';

if(isset($_POST["name"]) && isset($_POST["category"]) && isset($_POST["rangeFrom"]) && isset($_POST["rangeTo"])){

    $sql = "INSERT INTO recipe (recipe_name, category_id, range_from, range_to) VALUES('".$_POST["name"]."','".$_POST["category"]."','".$_POST["rangeFrom"]."','".$_POST["rangeTo"]."')";

    $data = array();

    if ($connection->query($sql) === TRUE) {
        $response = array('status' => 'success', 'message' => 'Recipe added');
    } else {
        $response = array('status' => 'error', 'message' => 'Failed to add recipe' . $connection->error);
    }


    // Close connection
    $connection->close();

    // Return data as JSON
    echo json_encode($data);
}


?>