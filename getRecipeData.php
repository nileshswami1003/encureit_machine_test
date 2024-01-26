<?php

require 'db.php';


// Query to get data from the database
$sql = "SELECT
r.recipe_id,
r.recipe_name,
r.category_id,
r.range_from,
r.range_to,
c.category_name
FROM
recipe r
LEFT JOIN
category c ON r.category_id = c.category_id;
";
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