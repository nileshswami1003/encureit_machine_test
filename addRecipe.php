<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
header('Content-Type: application/json');

require 'db.php';

if(isset($_POST["name"]) && isset($_POST["category"]) && isset($_POST["rangeFrom"]) && isset($_POST["rangeTo"])){

    $name = $_POST["name"];
    $category = $_POST["category"];
    $rangeFrom = $_POST["rangeFrom"];
    $rangeTo = $_POST["rangeTo"];

    //check this records exists with same range
    $sql = "SELECT * FROM recipe WHERE recipe_name='$name'";
    $exRangeFrom = 0;
    $exRangeTo = 0;
    $exCategory = 0;
    // Small => 1
    // Medium => 2
    // Large => 3
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        //if exists
        //get data
        while ($row = $result->fetch_assoc()) {
            $exCategory = $row["category_id"];
            $exRangeFrom = $row["range_from"];
            $exRangeTo = $row["range_to"];
        }

        if($exCategory < $category){
            //if new cate is greater than existing cat
            if($rangeFrom > $exRangeTo){
                // new from range should be greater than existing from range
                if($rangeTo > $rangeFrom){
                    //new to range should be greater than existing to range
                    $sql = "INSERT INTO recipe (recipe_name, category_id, range_from, range_to) VALUES('$name','$category','$rangeFrom','$rangeTo')";
                    $response = array();
                    if($connection->query($sql)===TRUE){                        
                        $response["status"] = "success";
                        $response["message"] = "Record added successfully";
                    }
                    else{
                        $response["status"] = "error";
                        $response["message"] = "Failed";
                    }
                    echo json_encode($response);
                    $connection->close();
                }
            }
        }
        else if($exCategory > $category){
            //if new cat is less than existing cat
            if($rangeFrom < $rangeTo){
                //new from range should be less than existing from range
                if($rangeTo < $exRangeFrom){
                    // new to range should be less than existing to range
                    $sql = "INSERT INTO recipe (recipe_name, category_id, range_from, range_to) VALUES('$name','$category','$rangeFrom','$rangeTo')";
                    $response = array();
                    if($connection->query($sql)===TRUE){
                        $response["status"] = "success";
                        $response["message"] = "Record added successfully";
                    }
                    else{
                        $response["status"] = "error";
                        $response["message"] = "Failed";
                    }
                    echo json_encode($response);
                    $connection->close();
                }
            }
        }
        else if($exCategory == $category){
            //if same category
            //abort
            $response = array();
            $response["status"] = "error";
            $response["message"] = "Recipe already exists";
            echo json_encode($response);
            $connection->close();
        }
        else{
            $response = array();
            $response["status"] = "error";
            $response["message"] = "Recipe already exists";
            echo json_encode($response);
            $connection->close();
        }
    }
    else{
        //new entry
        if($rangeTo > $rangeFrom){
            $sql = "INSERT INTO recipe (recipe_name, category_id, range_from, range_to) VALUES('$name','$category','$rangeFrom','$rangeTo')";
            
            if($connection->query($sql)===TRUE){
                $response["status"] = "success";
                $response["message"] = "Record added successfully";
            }
            else{
                $response["status"] = "error";
                $response["message"] = "Failed";
            }
            echo json_encode($response);
            $connection->close();
        }
        else{
            $response = array();
            $response["status"] = "error";
            $response["message"] = "Please enter valid range";
            echo json_encode($response);
            $connection->close();
        }
    }
}


?>