<?php
	include("db_connect.php");
	
	if(isset($_REQUEST["chk"]) && isset($_REQUEST["College_id"]))
	{
		
		
		$chk = $_REQUEST["chk"];
		$chk=rtrim($chk," ");
		$chkk=explode(" ",$chk);
		$College_id = $_REQUEST["College_id"];
		
		
		foreach($chkk as $item)
		{
		
	    $query="INSERT INTO `college_course_tb`(`Course_id`, `College_id`) VALUES ($item,$College_id)";
		$result = mysqli_query($con,$query);
		
		}

		
		if($result){
			//sucessfully inserted
			$response["success"] = 1;
			$response["message"] = "College Record successfully created.";
			$response["chk"] = $chkk;
			
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