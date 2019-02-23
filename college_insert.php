<?php
	include("db_connect.php");
	
	if(isset($_POST["College_name"]) && isset($_POST["College_location"]) && isset($_POST["College_email"]) && isset($_POST["College_webURL"]) && isset($_POST["College_password"]) && isset($_POST["College_contact"]))
	{
		$name = $_POST["College_name"];
		$location = $_POST["College_location"];
		$email = $_POST["College_email"];
		$url = $_POST["College_webURL"];
		$password = $_POST["College_password"];
		$contact = $_POST["College_contact"];
	    $query="INSERT INTO `college_tb`(`College_name`, `College_location`, `College_email`, `College_webURL`, `College_password`, `College_contact`) VALUES ('$name','$location','$email','$url','$password','$contact')";
//		$query="Insert into `college_tb`(`College_name`, `College_location`, `College_email`, `College_webURL`, `College_password`, `College_contact`) values ('$name','$location','$email','$url','$password','$contact')";
		$result = mysqli_query($con,$query);
		
		if($result){
			//sucessfully inserted
			$response["success"] = 1;
			$response["message"] = "College Record successfully created.";
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