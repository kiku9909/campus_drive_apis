<?php
	include("db_connect.php");

$response=array();

if(isset($_REQUEST["student_priority_id_string"]))
{
	$student_priority_id_string=$_REQUEST["student_priority_id_string"];
	$priority=1;
	
	$student_priority_id_string=rtrim($student_priority_id_string," ");
                $student_priority_id_strings=explode(" ",$student_priority_id_string);
                
                
               foreach($student_priority_id_strings as $item)
                {
                
					$query="UPDATE student_priority_tb SET Priority=$priority WHERE Student_priority_id=$item";
					
	
					$result=mysqli_query($con,$query);
					$priority++;
                }
	
	
	if($result)
	{
		// successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Company priority successfully created.";
		echo json_encode($response);
	}else {
        // failed to update row
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