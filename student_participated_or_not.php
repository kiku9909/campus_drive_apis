<?php
	include("db_connect.php");
	$response = array();
	
	if(isset($_REQUEST["job_fair_id"]) && isset($_REQUEST["job_seeker_id"]))
	{
		$job_seeker_id = $_REQUEST["job_seeker_id"];
		$job_fair_id = $_REQUEST["job_fair_id"];
		$query = "select Job_seeker_id,Job_fair_id from 
				  participated_student_tb
				  where 
				  Job_seeker_id=$job_seeker_id and Job_fair_id=$job_fair_id";
		$result = mysqli_query($con,$query);
		
		if(mysqli_num_rows($result)>0){
			//sucessfully inserted
			$response["Isparticipated"] = 1;
			$response["message"] = "Student has participated in this job fair";
			echo json_encode($response);
		}else{
			 // failed to insert row
			$response["Isparticipated"] = 0;
			$response["message"] = "Student has not participated in this job fair";
 
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