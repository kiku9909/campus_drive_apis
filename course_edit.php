<?php
include("db_connect.php");

$response=array();

if(isset($_REQUEST['id'])&& isset($_REQUEST['name']))
{
	$id=$_REQUEST['id'];
	$name=$_REQUEST['name'];
	
	$query="UPDATE `course_tb` SET `Course_name`='$name' WHERE course_id=$id";
	
	$result=mysqli_query($con,$query);
	
	if($result)
	{
		// successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Student Record successfully created.";
		echo json_encode($response);
	}else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
 
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
	
	


?>