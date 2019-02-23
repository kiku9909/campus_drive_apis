<?php
	include("db_connect.php");
	$response = array();
	
	if(isset($_REQUEST["job_fair_id"]) && isset($_REQUEST["job_seeker_id"]))
	{
		$job_seeker_id = $_REQUEST["job_seeker_id"];
		$job_fair_id = $_REQUEST["job_fair_id"];
		$query = "insert into participated_student_tb(Job_seeker_id,Job_fair_id)values($job_seeker_id,$job_fair_id)";
		$result = mysqli_query($con,$query);
		
		if($result){
			//sucessfully inserted
			$response["success"] = 1;
			$response["message"] = "participated Student Record successfully created.";
			echo json_encode($response);
		}else{
			 // failed to insert row
			$response["success"] = 0;
			$response["message"] = "Oops! An error occurred.";
 
			// echoing JSON response
			echo json_encode($response);
		}
	}
	else{
		 // required field is missing
		$response["success"] = 0;
		$response["message"] = "Required field(s) is missing";
 
		// echoing JSON response
		echo json_encode($response);
	}
?>