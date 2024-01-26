<?php

require 'db.php';


// Query to get data from the database
$sql = "SELECT * FROM category";
$result = $connection->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Close connection
$connection->close();

// Return data as JSON
echo json_encode($data);



?>